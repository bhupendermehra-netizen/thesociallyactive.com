if($("#bannerCanvas").length){


function HSVtoRGB(h, s, v) {
  let r, g, b, i, f, p, q, t;
  i = Math.floor(h * 6);
  f = h * 6 - i;
  p = v * (1 - s);
  q = v * (1 - f * s);
  t = v * (1 - (1 - f) * s);
  switch (i % 6) {
    case 0: r = v; g = t; b = p; break;
    case 1: r = q; g = v; b = p; break;
    case 2: r = p; g = v; b = t; break;
    case 3: r = p; g = q; b = v; break;
    case 4: r = t; g = p; b = v; break;
    case 5: r = v; g = p; b = q; break;
  }
  return { r, g, b };
}

function hashCode(s) {
  if (s.length === 0) return 0;
  let hash = 0;
  for (let i = 0; i < s.length; i++) {
    hash = (hash << 5) - hash + s.charCodeAt(i);
    hash |= 0; // 32bit整数に変換
  }
  return hash;
}


// =================================================================
// ===== シェーダーコード定義 ========================================
// =================================================================
// シェーダーコードを一箇所にまとめて管理しやすくする
const Shaders = {
  baseVertex: `
    precision highp float;
    attribute vec2 aPosition;
    varying vec2 vUv;
    varying vec2 vL;
    varying vec2 vR;
    varying vec2 vT;
    varying vec2 vB;
    uniform vec2 texelSize;
    void main () {
        vUv = aPosition * 0.5 + 0.5;
        vL = vUv - vec2(texelSize.x, 0.0);
        vR = vUv + vec2(texelSize.x, 0.0);
        vT = vUv + vec2(0.0, texelSize.y);
        vB = vUv - vec2(0.0, texelSize.y);
        gl_Position = vec4(aPosition, 0.0, 1.0);
    }`,
  copy: `
    precision mediump float;
    precision mediump sampler2D;
    varying highp vec2 vUv;
    uniform sampler2D uTexture;
    void main () {
        gl_FragColor = texture2D(uTexture, vUv);
    }`,
  clear: `
    precision mediump float;
    precision mediump sampler2D;
    varying highp vec2 vUv;
    uniform sampler2D uTexture;
    uniform float value;
    void main () {
        gl_FragColor = value * texture2D(uTexture, vUv);
    }`,
  color: `
    precision mediump float;
    uniform vec4 color;
    void main () {
        gl_FragColor = color;
    }`,
  checkerboard: `
    precision highp float;
    precision highp sampler2D;
    varying vec2 vUv;
    uniform float aspectRatio;
    #define SCALE 25.0
    void main () {
        vec2 uv = floor(vUv * SCALE * vec2(aspectRatio, 1.0));
        float v = mod(uv.x + uv.y, 2.0);
        v = v * 0.1 + 0.8;
        gl_FragColor = vec4(vec3(v), 1.0);
    }`,
  display: `
    precision highp float;
    precision highp sampler2D;
    varying vec2 vUv;
    varying vec2 vL;
    varying vec2 vR;
    varying vec2 vT;
    varying vec2 vB;
    uniform sampler2D uTexture;
    uniform vec2 texelSize;
    void main () {
        vec3 c = texture2D(uTexture, vUv).rgb;
    #ifdef SHADING
        vec3 lc = texture2D(uTexture, vL).rgb;
        vec3 rc = texture2D(uTexture, vR).rgb;
        vec3 tc = texture2D(uTexture, vT).rgb;
        vec3 bc = texture2D(uTexture, vB).rgb;
        float dx = length(rc) - length(lc);
        float dy = length(tc) - length(bc);
        vec3 n = normalize(vec3(dx, dy, length(texelSize)));
        vec3 l = vec3(0.0, 0.0, 1.0);
        float diffuse = clamp(dot(n, l) + 0.7, 0.7, 1.0);
        c *= diffuse;
    #endif
        float a = max(c.r, max(c.g, c.b));
        gl_FragColor = vec4(c, a);
    }`,
  splat: `
    precision highp float;
    precision highp sampler2D;
    varying vec2 vUv;
    uniform sampler2D uTarget;
    uniform float aspectRatio;
    uniform vec3 color;
    uniform vec2 point;
    uniform float radius;
    void main () {
        vec2 p = vUv - point.xy;
        p.x *= aspectRatio;
        vec3 splat = exp(-dot(p, p) / radius) * color;
        vec3 base = texture2D(uTarget, vUv).xyz;
        gl_FragColor = vec4(base + splat, 1.0);
    }`,
  advection: `
    precision highp float;
    precision highp sampler2D;
    varying vec2 vUv;
    uniform sampler2D uVelocity;
    uniform sampler2D uSource;
    uniform vec2 texelSize;
    uniform vec2 dyeTexelSize;
    uniform float dt;
    uniform float dissipation;
    vec4 bilerp (sampler2D sam, vec2 uv, vec2 tsize) {
        vec2 st = uv / tsize - 0.5;
        vec2 iuv = floor(st);
        vec2 fuv = fract(st);
        vec4 a = texture2D(sam, (iuv + vec2(0.5, 0.5)) * tsize);
        vec4 b = texture2D(sam, (iuv + vec2(1.5, 0.5)) * tsize);
        vec4 c = texture2D(sam, (iuv + vec2(0.5, 1.5)) * tsize);
        vec4 d = texture2D(sam, (iuv + vec2(1.5, 1.5)) * tsize);
        return mix(mix(a, b, fuv.x), mix(c, d, fuv.x), fuv.y);
    }
    void main () {
    #ifdef MANUAL_FILTERING
        vec2 coord = vUv - dt * bilerp(uVelocity, vUv, texelSize).xy * texelSize;
        vec4 result = bilerp(uSource, coord, dyeTexelSize);
    #else
        vec2 coord = vUv - dt * texture2D(uVelocity, vUv).xy * texelSize;
        vec4 result = texture2D(uSource, coord);
    #endif
        float decay = 1.0 + dissipation * dt;
        gl_FragColor = result / decay;
    }`,
  divergence: `
    precision mediump float;
    precision mediump sampler2D;
    varying highp vec2 vUv;
    varying highp vec2 vL;
    varying highp vec2 vR;
    varying highp vec2 vT;
    varying highp vec2 vB;
    uniform sampler2D uVelocity;
    void main () {
        float L = texture2D(uVelocity, vL).x;
        float R = texture2D(uVelocity, vR).x;
        float T = texture2D(uVelocity, vT).y;
        float B = texture2D(uVelocity, vB).y;
        vec2 C = texture2D(uVelocity, vUv).xy;
        if (vL.x < 0.0) { L = -C.x; }
        if (vR.x > 1.0) { R = -C.x; }
        if (vT.y > 1.0) { T = -C.y; }
        if (vB.y < 0.0) { B = -C.y; }
        float div = 0.5 * (R - L + T - B);
        gl_FragColor = vec4(div, 0.0, 0.0, 1.0);
    }`,
  curl: `
    precision mediump float;
    precision mediump sampler2D;
    varying highp vec2 vUv;
    varying highp vec2 vL;
    varying highp vec2 vR;
    varying highp vec2 vT;
    varying highp vec2 vB;
    uniform sampler2D uVelocity;
    void main () {
        float L = texture2D(uVelocity, vL).y;
        float R = texture2D(uVelocity, vR).y;
        float T = texture2D(uVelocity, vT).x;
        float B = texture2D(uVelocity, vB).x;
        float vorticity = R - L - T + B;
        gl_FragColor = vec4(0.5 * vorticity, 0.0, 0.0, 1.0);
    }`,
  vorticity: `
    precision highp float;
    precision highp sampler2D;
    varying vec2 vUv;
    varying vec2 vL;
    varying vec2 vR;
    varying vec2 vT;
    varying vec2 vB;
    uniform sampler2D uVelocity;
    uniform sampler2D uCurl;
    uniform float curl;
    uniform float dt;
    void main () {
        float L = texture2D(uCurl, vL).x;
        float R = texture2D(uCurl, vR).x;
        float T = texture2D(uCurl, vT).x;
        float B = texture2D(uCurl, vB).x;
        float C = texture2D(uCurl, vUv).x;
        vec2 force = 0.5 * vec2(abs(T) - abs(B), abs(R) - abs(L));
        force /= length(force) + 0.0001;
        force *= curl * C;
        force.y *= -1.0;
        vec2 vel = texture2D(uVelocity, vUv).xy;
        gl_FragColor = vec4(vel + force * dt, 0.0, 1.0);
    }`,
  pressure: `
    precision mediump float;
    precision mediump sampler2D;
    varying highp vec2 vUv;
    varying highp vec2 vL;
    varying highp vec2 vR;
    varying highp vec2 vT;
    varying highp vec2 vB;
    uniform sampler2D uPressure;
    uniform sampler2D uDivergence;
    void main () {
        float L = texture2D(uPressure, vL).x;
        float R = texture2D(uPressure, vR).x;
        float T = texture2D(uPressure, vT).x;
        float B = texture2D(uPressure, vB).x;
        float divergence = texture2D(uDivergence, vUv).x;
        float pressure = (L + R + B + T - divergence) * 0.25;
        gl_FragColor = vec4(pressure, 0.0, 0.0, 1.0);
    }`,
  gradientSubtract: `
    precision mediump float;
    precision mediump sampler2D;
    varying highp vec2 vUv;
    varying highp vec2 vL;
    varying highp vec2 vR;
    varying highp vec2 vT;
    varying highp vec2 vB;
    uniform sampler2D uPressure;
    uniform sampler2D uVelocity;
    void main () {
        float L = texture2D(uPressure, vL).x;
        float R = texture2D(uPressure, vR).x;
        float T = texture2D(uPressure, vT).x;
        float B = texture2D(uPressure, vB).x;
        vec2 velocity = texture2D(uVelocity, vUv).xy;
        velocity.xy -= vec2(R - L, T - B);
        gl_FragColor = vec4(velocity, 0.0, 1.0);
    }`,
};


// =================================================================
// ===== FluidSimulation クラス定義 =================================
// =================================================================
/**
 * WebGL流体シミュレーションを管理するメインクラス
 */
class FluidSimulation {
  constructor(canvas, config) {
    this.canvas = canvas;
    this.config = config;

    this.pointers = [];
    this.splatStack = [];

    this.gl = null;
    this.ext = {};
    this.programs = {};
    this.materials = {};
    this.fbos = {};

    this.lastUpdateTime = Date.now();
    this.colorUpdateTimer = 0.0;

    this.init();
  }

  // ===== 初期化処理 =====

  init() {
    this.pointers.push({
      id: -1, texcoordX: 0, texcoordY: 0, prevTexcoordX: 0, prevTexcoordY: 0,
      deltaX: 0, deltaY: 0, down: false, moved: false, color: [30, 0, 300]
    });

    this.initWebGL();
    if (!this.gl) {
      console.error("WebGL context could not be initialized.");
      return;
    }

    this.initPrograms();
    this.initFramebuffers();
    this.initGUI();
    this.initEventListeners();
    
    this.updateKeywords();
    
    this.start();
  }

  initWebGL() {
    const { gl, ext } = this.getWebGLContext(this.canvas);
    this.gl = gl;
    this.ext = ext;

    if (this.isMobile()) {
      this.config.SIM_RESOLUTION = 64;
      this.config.DYE_RESOLUTION = 512;
    }
    if (!this.ext.supportLinearFiltering) {
      this.config.DYE_RESOLUTION = 512;
      this.config.SHADING = false;
    }
  }

  initPrograms() {
    const gl = this.gl;
    const baseVertexShader = this.compileShader(gl.VERTEX_SHADER, Shaders.baseVertex);
    
    // シェーダーごとにプログラムを生成
    this.programs.copy = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.copy));
    this.programs.clear = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.clear));
    this.programs.color = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.color));
    this.programs.checkerboard = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.checkerboard));
    this.programs.splat = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.splat));
    this.programs.advection = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.advection, this.ext.supportLinearFiltering ? null : ['MANUAL_FILTERING']));
    this.programs.divergence = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.divergence));
    this.programs.curl = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.curl));
    this.programs.vorticity = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.vorticity));
    this.programs.pressure = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.pressure));
    this.programs.gradientSubtract = this.createProgram(baseVertexShader, this.compileShader(gl.FRAGMENT_SHADER, Shaders.gradientSubtract));

    // マテリアル（キーワードでシェーダーを切り替える）
    this.materials.display = this.createMaterial(baseVertexShader, Shaders.display);
  }

  initFramebuffers() {
    const simRes = this.getResolution(this.config.SIM_RESOLUTION);
    const dyeRes = this.getResolution(this.config.DYE_RESOLUTION);

    const { halfFloatTexType, formatRGBA, formatRG, formatR, supportLinearFiltering } = this.ext;
    const filtering = supportLinearFiltering ? this.gl.LINEAR : this.gl.NEAREST;
    
    this.fbos.dye = this.createOrResizeDoubleFBO(this.fbos.dye, dyeRes.width, dyeRes.height, formatRGBA.internalFormat, formatRGBA.format, halfFloatTexType, filtering);
    this.fbos.velocity = this.createOrResizeDoubleFBO(this.fbos.velocity, simRes.width, simRes.height, formatRG.internalFormat, formatRG.format, halfFloatTexType, filtering);
    
    this.fbos.divergence = this.createOrResizeFBO(this.fbos.divergence, simRes.width, simRes.height, formatR.internalFormat, formatR.format, halfFloatTexType, this.gl.NEAREST);
    this.fbos.curl = this.createOrResizeFBO(this.fbos.curl, simRes.width, simRes.height, formatR.internalFormat, formatR.format, halfFloatTexType, this.gl.NEAREST);
    this.fbos.pressure = this.createOrResizeDoubleFBO(this.fbos.pressure, simRes.width, simRes.height, formatR.internalFormat, formatR.format, halfFloatTexType, this.gl.NEAREST);
  }

  initGUI() {
    if (!window.dat || !this.config.SHOW_GUI) return;
    
    const gui = new dat.GUI({ width: 300 });
    const onFinishChange = () => this.initFramebuffers();

    gui.add(this.config, 'DYE_RESOLUTION', { 'high': 1024, 'medium': 512, 'low': 256, 'very low': 128 }).name('quality').onFinishChange(onFinishChange);
    gui.add(this.config, 'SIM_RESOLUTION', { '32': 32, '64': 64, '128': 128, '256': 256 }).name('sim resolution').onFinishChange(onFinishChange);
    gui.add(this.config, 'DENSITY_DISSIPATION', 0, 4.0).name('density diffusion');
    gui.add(this.config, 'VELOCITY_DISSIPATION', 0, 4.0).name('velocity diffusion');
    gui.add(this.config, 'PRESSURE', 0.0, 1.0).name('pressure');
    gui.add(this.config, 'CURL', 0, 50).name('vorticity').step(1);
    gui.add(this.config, 'SPLAT_RADIUS', 0.01, 1.0).name('splat radius');
    gui.add(this.config, 'SHADING').name('shading').onFinishChange(() => this.updateKeywords());
    gui.add(this.config, 'COLORFUL').name('colorful');
    gui.add(this.config, 'PAUSED').name('paused').listen();
    gui.add({ fun: () => { this.splatStack.push(parseInt(Math.random() * 20) + 5); } }, 'fun').name('Random splats');
    
    if (this.isMobile()) gui.close();
  }

  initEventListeners() {
    this.updatePointerDownData(this.pointers[0], -1, 0, 0);

    document.body.addEventListener('mousemove', e => {
      const pointer = this.pointers[0];
      if (!pointer.down) return;
      const posX = this.scaleByPixelRatio(e.clientX);
      const posY = this.scaleByPixelRatio(e.clientY);
      this.updatePointerMoveData(pointer, posX, posY);
    });
  }

  // ===== メインループと描画処理 =====

  start() {
    this.lastUpdateTime = Date.now();
    this.resizeCanvas();
    this.update();
  }

  update() {
    const dt = this.calcDeltaTime();
    if (this.resizeCanvas()) {
      this.initFramebuffers();
    }
    this.updateColors(dt);
    this.applyInputs();
    if (!this.config.PAUSED) {
      this.step(dt);
    }
    this.render();
    requestAnimationFrame(this.update.bind(this));
  }

  step(dt) {
    const gl = this.gl;
    const { velocity, curl, pressure, divergence, dye } = this.fbos;
    const { curl: curlProgram, vorticity: vorticityProgram, divergence: divergenceProgram, clear: clearProgram, pressure: pressureProgram, gradientSubtract: gradienSubtractProgram, advection: advectionProgram } = this.programs;

    gl.disable(gl.BLEND);
    gl.viewport(0, 0, velocity.width, velocity.height);

    // 1. 渦度計算
    this.bindProgram(curlProgram);
    gl.uniform2f(curlProgram.uniforms.texelSize, velocity.texelSizeX, velocity.texelSizeY);
    gl.uniform1i(curlProgram.uniforms.uVelocity, velocity.read.attach(0));
    this.blit(curl.fbo);

    // 2. 渦度による力の適用
    this.bindProgram(vorticityProgram);
    gl.uniform2f(vorticityProgram.uniforms.texelSize, velocity.texelSizeX, velocity.texelSizeY);
    gl.uniform1i(vorticityProgram.uniforms.uVelocity, velocity.read.attach(0));
    gl.uniform1i(vorticityProgram.uniforms.uCurl, curl.attach(1));
    gl.uniform1f(vorticityProgram.uniforms.curl, this.config.CURL);
    gl.uniform1f(vorticityProgram.uniforms.dt, dt);
    this.blit(velocity.write.fbo);
    velocity.swap();

    // 3. 発散計算
    this.bindProgram(divergenceProgram);
    gl.uniform2f(divergenceProgram.uniforms.texelSize, velocity.texelSizeX, velocity.texelSizeY);
    gl.uniform1i(divergenceProgram.uniforms.uVelocity, velocity.read.attach(0));
    this.blit(divergence.fbo);

    // 4. 圧力場のクリア
    this.bindProgram(clearProgram);
    gl.uniform1i(clearProgram.uniforms.uTexture, pressure.read.attach(0));
    gl.uniform1f(clearProgram.uniforms.value, this.config.PRESSURE);
    this.blit(pressure.write.fbo);
    pressure.swap();

    // 5. 圧力計算 (反復)
    this.bindProgram(pressureProgram);
    gl.uniform2f(pressureProgram.uniforms.texelSize, velocity.texelSizeX, velocity.texelSizeY);
    gl.uniform1i(pressureProgram.uniforms.uDivergence, divergence.attach(0));
    for (let i = 0; i < this.config.PRESSURE_ITERATIONS; i++) {
      gl.uniform1i(pressureProgram.uniforms.uPressure, pressure.read.attach(1));
      this.blit(pressure.write.fbo);
      pressure.swap();
    }
    
    // 6. 圧力勾配を速度場から減算
    this.bindProgram(gradienSubtractProgram);
    gl.uniform2f(gradienSubtractProgram.uniforms.texelSize, velocity.texelSizeX, velocity.texelSizeY);
    gl.uniform1i(gradienSubtractProgram.uniforms.uPressure, pressure.read.attach(0));
    gl.uniform1i(gradienSubtractProgram.uniforms.uVelocity, velocity.read.attach(1));
    this.blit(velocity.write.fbo);
    velocity.swap();

    // 7. 移流 (速度場)
    this.bindProgram(advectionProgram);
    gl.uniform2f(advectionProgram.uniforms.texelSize, velocity.texelSizeX, velocity.texelSizeY);
    if (!this.ext.supportLinearFiltering) {
      gl.uniform2f(advectionProgram.uniforms.dyeTexelSize, velocity.texelSizeX, velocity.texelSizeY);
    }
    const velocityId = velocity.read.attach(0);
    gl.uniform1i(advectionProgram.uniforms.uVelocity, velocityId);
    gl.uniform1i(advectionProgram.uniforms.uSource, velocityId);
    gl.uniform1f(advectionProgram.uniforms.dt, dt);
    gl.uniform1f(advectionProgram.uniforms.dissipation, this.config.VELOCITY_DISSIPATION);
    this.blit(velocity.write.fbo);
    velocity.swap();
    
    // 8. 移流 (色)
    gl.viewport(0, 0, dye.width, dye.height);
    if (!this.ext.supportLinearFiltering) {
      gl.uniform2f(advectionProgram.uniforms.dyeTexelSize, dye.texelSizeX, dye.texelSizeY);
    }
    gl.uniform1i(advectionProgram.uniforms.uVelocity, velocity.read.attach(0));
    gl.uniform1i(advectionProgram.uniforms.uSource, dye.read.attach(1));
    gl.uniform1f(advectionProgram.uniforms.dissipation, this.config.DENSITY_DISSIPATION);
    this.blit(dye.write.fbo);
    dye.swap();
  }
  
  render() {
    const gl = this.gl;
    const { TRANSPARENT, BACK_COLOR } = this.config;

    if (!TRANSPARENT) {
      gl.blendFunc(gl.ONE, gl.ONE_MINUS_SRC_ALPHA);
      gl.enable(gl.BLEND);
    } else {
      gl.disable(gl.BLEND);
    }

    const width = gl.drawingBufferWidth;
    const height = gl.drawingBufferHeight;
    gl.viewport(0, 0, width, height);

    if (!TRANSPARENT) {
      const c = this.normalizeColor(BACK_COLOR);
      this.drawColor(null, c.r, c.g, c.b);
    } else {
      this.drawCheckerboard(null);
    }
    this.drawDisplay(null, width, height);
  }

  // ===== WebGL & FBO ヘルパーメソッド =====
  
  getWebGLContext(canvas) {
    const params = { alpha: true, depth: false, stencil: false, antialias: false, preserveDrawingBuffer: false };
    let gl = canvas.getContext('webgl2', params);
    const isWebGL2 = !!gl;
    if (!isWebGL2) {
      gl = canvas.getContext('webgl', params) || canvas.getContext('experimental-webgl', params);
    }
    
    let halfFloat;
    let supportLinearFiltering;
    if (isWebGL2) {
      gl.getExtension('EXT_color_buffer_float');
      supportLinearFiltering = gl.getExtension('OES_texture_float_linear');
    } else {
      halfFloat = gl.getExtension('OES_texture_half_float');
      supportLinearFiltering = gl.getExtension('OES_texture_half_float_linear');
    }
    gl.clearColor(0.0, 0.0, 0.0, 1.0);
    
    const halfFloatTexType = isWebGL2 ? gl.HALF_FLOAT : halfFloat.HALF_FLOAT_OES;
    let formatRGBA, formatRG, formatR;
    if (isWebGL2) {
      formatRGBA = this.getSupportedFormat(gl, gl.RGBA16F, gl.RGBA, halfFloatTexType);
      formatRG = this.getSupportedFormat(gl, gl.RG16F, gl.RG, halfFloatTexType);
      formatR = this.getSupportedFormat(gl, gl.R16F, gl.RED, halfFloatTexType);
    } else {
      formatRGBA = this.getSupportedFormat(gl, gl.RGBA, gl.RGBA, halfFloatTexType);
      formatRG = this.getSupportedFormat(gl, gl.RGBA, gl.RGBA, halfFloatTexType);
      formatR = this.getSupportedFormat(gl, gl.RGBA, gl.RGBA, halfFloatTexType);
    }
    
    return {
      gl,
      ext: { formatRGBA, formatRG, formatR, halfFloatTexType, supportLinearFiltering }
    };
  }

  getSupportedFormat(gl, internalFormat, format, type) {
    if (!this.supportRenderTextureFormat(gl, internalFormat, format, type)) {
      switch (internalFormat) {
        case gl.R16F: return this.getSupportedFormat(gl, gl.RG16F, gl.RG, type);
        case gl.RG16F: return this.getSupportedFormat(gl, gl.RGBA16F, gl.RGBA, type);
        default: return null;
      }
    }
    return { internalFormat, format };
  }

  supportRenderTextureFormat(gl, internalFormat, format, type) {
    const texture = gl.createTexture();
    gl.bindTexture(gl.TEXTURE_2D, texture);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.NEAREST);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.NEAREST);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
    gl.texImage2D(gl.TEXTURE_2D, 0, internalFormat, 4, 4, 0, format, type, null);
    
    const fbo = gl.createFramebuffer();
    gl.bindFramebuffer(gl.FRAMEBUFFER, fbo);
    gl.framebufferTexture2D(gl.FRAMEBUFFER, gl.COLOR_ATTACHMENT0, gl.TEXTURE_2D, texture, 0);
    
    const status = gl.checkFramebufferStatus(gl.FRAMEBUFFER);
    gl.deleteTexture(texture);
    gl.deleteFramebuffer(fbo);
    return status === gl.FRAMEBUFFER_COMPLETE;
  }
  
  createProgram(vertexShader, fragmentShader) {
    const gl = this.gl;
    const program = gl.createProgram();
    gl.attachShader(program, vertexShader);
    gl.attachShader(program, fragmentShader);
    gl.linkProgram(program);

    if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
      throw gl.getProgramInfoLog(program);
    }

    const uniforms = {};
    const uniformCount = gl.getProgramParameter(program, gl.ACTIVE_UNIFORMS);
    for (let i = 0; i < uniformCount; i++) {
      const uniformName = gl.getActiveUniform(program, i).name;
      uniforms[uniformName] = gl.getUniformLocation(program, uniformName);
    }
    return { program, uniforms };
  }
  
  createMaterial(vertexShader, fragmentShaderSource) {
    const gl = this.gl;
    const material = {
      vertexShader,
      fragmentShaderSource,
      programs: [],
      activeProgram: null,
      uniforms: [],
      setKeywords: (keywords) => {
        let hash = 0;
        for (let i = 0; i < keywords.length; i++) {
          hash += hashCode(keywords[i]);
        }
        
        let program = material.programs[hash];
        if (program == null) {
          const fragmentShader = this.compileShader(gl.FRAGMENT_SHADER, material.fragmentShaderSource, keywords);
          program = this.createProgram(material.vertexShader, fragmentShader);
          material.programs[hash] = program;
        }

        if (program === material.activeProgram) return;

        material.uniforms = program.uniforms;
        material.activeProgram = program;
      },
      bind: () => {
        gl.useProgram(material.activeProgram.program);
      }
    };
    return material;
  }

  compileShader(type, source, keywords = null) {
    const gl = this.gl;
    if (keywords != null) {
      const keywordsString = keywords.map(keyword => `#define ${keyword}\n`).join('');
      source = keywordsString + source;
    }

    const shader = gl.createShader(type);
    gl.shaderSource(shader, source);
    gl.compileShader(shader);

    if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
      throw gl.getShaderInfoLog(shader);
    }
    return shader;
  }
  
  createFBO(w, h, internalFormat, format, type, param) {
    const gl = this.gl;
    gl.activeTexture(gl.TEXTURE0);
    const texture = gl.createTexture();
    gl.bindTexture(gl.TEXTURE_2D, texture);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, param);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, param);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
    gl.texImage2D(gl.TEXTURE_2D, 0, internalFormat, w, h, 0, format, type, null);

    const fbo = gl.createFramebuffer();
    gl.bindFramebuffer(gl.FRAMEBUFFER, fbo);
    gl.framebufferTexture2D(gl.FRAMEBUFFER, gl.COLOR_ATTACHMENT0, gl.TEXTURE_2D, texture, 0);
    gl.viewport(0, 0, w, h);
    gl.clear(gl.COLOR_BUFFER_BIT);

    return {
      texture, fbo, width: w, height: h,
      texelSizeX: 1.0 / w, texelSizeY: 1.0 / h,
      attach: (id) => {
        gl.activeTexture(gl.TEXTURE0 + id);
        gl.bindTexture(gl.TEXTURE_2D, texture);
        return id;
      }
    };
  }

  createDoubleFBO(w, h, internalFormat, format, type, param) {
    let fbo1 = this.createFBO(w, h, internalFormat, format, type, param);
    let fbo2 = this.createFBO(w, h, internalFormat, format, type, param);

    return {
      width: w, height: h,
      texelSizeX: fbo1.texelSizeX, texelSizeY: fbo1.texelSizeY,
      get read() { return fbo1; },
      set read(value) { fbo1 = value; },
      get write() { return fbo2; },
      set write(value) { fbo2 = value; },
      swap() {
        const temp = fbo1;
        fbo1 = fbo2;
        fbo2 = temp;
      }
    };
  }

  createOrResizeFBO(fbo, w, h, internalFormat, format, type, param) {
    if (fbo == null || fbo.width !== w || fbo.height !== h) {
      const newFBO = this.createFBO(w, h, internalFormat, format, type, param);
      if(fbo) {
        this.bindProgram(this.programs.copy);
        this.gl.uniform1i(this.programs.copy.uniforms.uTexture, fbo.attach(0));
        this.blit(newFBO.fbo);
        // TODO: 古いFBOを削除する処理を追加
      }
      return newFBO;
    }
    return fbo;
  }

  createOrResizeDoubleFBO(dfbo, w, h, internalFormat, format, type, param) {
    if (dfbo == null || dfbo.width !== w || dfbo.height !== h) {
      const newDFBO = this.createDoubleFBO(w, h, internalFormat, format, type, param);
      if(dfbo) {
         this.bindProgram(this.programs.copy);
         this.gl.uniform1i(this.programs.copy.uniforms.uTexture, dfbo.read.attach(0));
         this.blit(newDFBO.read.fbo);
         // TODO: 古いDFBOを削除する処理を追加
      }
      return newDFBO;
    }
    dfbo.width = w; dfbo.height = h;
    dfbo.texelSizeX = 1.0 / w; dfbo.texelSizeY = 1.0 / h;
    return dfbo;
  }

  bindProgram(program) {
    this.gl.useProgram(program.program);
  }

  blit(destination) {
    const gl = this.gl;
    // この頂点データは一度だけ設定すればよい
    // ただし、VAOを使わない場合は毎回設定が必要になる可能性がある
    // 今回はシンプルにするため、毎回bindしているが、
    // パフォーマンスを求めるならVAOで管理するのが望ましい
    const positionBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, positionBuffer);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, -1, 1, 1, 1, 1, -1]), gl.STATIC_DRAW);
    
    const indexBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, indexBuffer);
    gl.bufferData(gl.ELEMENT_ARRAY_BUFFER, new Uint16Array([0, 1, 2, 0, 2, 3]), gl.STATIC_DRAW);

    const pos_loc = gl.getAttribLocation(this.programs.copy.program, 'aPosition'); // どれか一つのプログラムから取得すればOK
    gl.enableVertexAttribArray(pos_loc);
    gl.vertexAttribPointer(pos_loc, 2, gl.FLOAT, false, 0, 0);

    gl.bindFramebuffer(gl.FRAMEBUFFER, destination);
    gl.drawElements(gl.TRIANGLES, 6, gl.UNSIGNED_SHORT, 0);
    
    gl.deleteBuffer(positionBuffer);
    gl.deleteBuffer(indexBuffer);
  }

  // ===== アプリケーションロジックメソッド =====

  updateKeywords() {
    const displayKeywords = [];
    if (this.config.SHADING) displayKeywords.push("SHADING");
    this.materials.display.setKeywords(displayKeywords);
  }

  calcDeltaTime() {
    const now = Date.now();
    let dt = (now - this.lastUpdateTime) / 1000;
    dt = Math.min(dt, 0.016666); // 最大値を約60fpsに制限
    this.lastUpdateTime = now;
    return dt;
  }

  resizeCanvas() {
    const width = this.scaleByPixelRatio(this.canvas.clientWidth);
    const height = this.scaleByPixelRatio(this.canvas.clientHeight);
    if (this.canvas.width !== width || this.canvas.height !== height) {
      this.canvas.width = width;
      this.canvas.height = height;
      return true;
    }
    return false;
  }

  updateColors(dt) {
    if (!this.config.COLORFUL) return;
    this.colorUpdateTimer += dt * this.config.COLOR_UPDATE_SPEED;
    if (this.colorUpdateTimer >= 1) {
      this.colorUpdateTimer %= 1.0;
      this.pointers.forEach(p => {
        p.color = this.generateColor();
      });
    }
  }

  applyInputs() {
    if (this.splatStack.length > 0) {
      this.multipleSplats(this.splatStack.pop());
    }
    this.pointers.forEach(p => {
      if (p.moved) {
        p.moved = false;
        this.splatPointer(p);
      }
    });
  }

  splatPointer(pointer) {
    const dx = pointer.deltaX * this.config.SPLAT_FORCE;
    const dy = pointer.deltaY * this.config.SPLAT_FORCE;
    this.splat(pointer.texcoordX, pointer.texcoordY, dx, dy, pointer.color);
  }

  multipleSplats(amount) {
    for (let i = 0; i < amount; i++) {
      const color = this.generateColor();
      color.r *= 10.0;
      color.g *= 10.0;
      color.b *= 10.0;
      const x = Math.random();
      const y = Math.random();
      const dx = 1000 * (Math.random() - 0.5);
      const dy = 1000 * (Math.random() - 0.5);
      this.splat(x, y, dx, dy, color);
    }
  }

  splat(x, y, dx, dy, color) {
    const gl = this.gl;
    const { velocity, dye } = this.fbos;
    const splatProgram = this.programs.splat;

    this.bindProgram(splatProgram);
    gl.viewport(0, 0, velocity.width, velocity.height);
    gl.uniform1i(splatProgram.uniforms.uTarget, velocity.read.attach(0));
    gl.uniform1f(splatProgram.uniforms.aspectRatio, this.canvas.width / this.canvas.height);
    gl.uniform2f(splatProgram.uniforms.point, x, y);
    gl.uniform3f(splatProgram.uniforms.color, dx, dy, 0.0);
    gl.uniform1f(splatProgram.uniforms.radius, this.correctRadius(this.config.SPLAT_RADIUS / 100.0));
    this.blit(velocity.write.fbo);
    velocity.swap();

    gl.viewport(0, 0, dye.width, dye.height);
    gl.uniform1i(splatProgram.uniforms.uTarget, dye.read.attach(0));
    gl.uniform3f(splatProgram.uniforms.color, color.r, color.g, color.b);
    this.blit(dye.write.fbo);
    dye.swap();
  }
  
  // ===== 描画ヘルパー =====

  drawColor(fbo, r, g, b) {
    const program = this.programs.color;
    this.bindProgram(program);
    this.gl.uniform4f(program.uniforms.color, r, g, b, 1);
    this.blit(fbo);
  }

  drawCheckerboard(fbo) {
    const program = this.programs.checkerboard;
    this.bindProgram(program);
    this.gl.uniform1f(program.uniforms.aspectRatio, this.canvas.width / this.canvas.height);
    this.blit(fbo);
  }

  drawDisplay(fbo, width, height) {
    const material = this.materials.display;
    material.bind();
    if (this.config.SHADING) {
      this.gl.uniform2f(material.uniforms.texelSize, 1.0 / width, 1.0 / height);
    }
    this.gl.uniform1i(material.uniforms.uTexture, this.fbos.dye.read.attach(0));
    this.blit(fbo);
  }

  // ===== ポインターイベントメソッド =====
  
  updatePointerDownData(pointer, id, posX, posY) {
    pointer.id = id;
    pointer.down = true;
    pointer.moved = false;
    pointer.texcoordX = posX / this.canvas.width;
    pointer.texcoordY = 1.0 - posY / this.canvas.height;
    pointer.prevTexcoordX = pointer.texcoordX;
    pointer.prevTexcoordY = pointer.texcoordY;
    pointer.deltaX = 0;
    pointer.deltaY = 0;
    pointer.color = this.generateColor();
  }

  updatePointerMoveData(pointer, posX, posY) {
    pointer.prevTexcoordX = pointer.texcoordX;
    pointer.prevTexcoordY = pointer.texcoordY;
    pointer.texcoordX = posX / this.canvas.width;
    pointer.texcoordY = 1.0 - posY / this.canvas.height;
    pointer.deltaX = this.correctDeltaX(pointer.texcoordX - pointer.prevTexcoordX);
    pointer.deltaY = this.correctDeltaY(pointer.texcoordY - pointer.prevTexcoordY);
    pointer.moved = Math.abs(pointer.deltaX) > 0 || Math.abs(pointer.deltaY) > 0;
  }
  
  // ===== 汎用ユーティリティメソッド =====
  
  isMobile() { return /Mobi|Android/i.test(navigator.userAgent); }

  correctRadius(radius) {
    const aspectRatio = this.canvas.width / this.canvas.height;
    if (aspectRatio > 1) radius *= aspectRatio;
    return radius;
  }
  
  correctDeltaX(delta) {
    const aspectRatio = this.canvas.width / this.canvas.height;
    if (aspectRatio < 1) delta *= aspectRatio;
    return delta;
  }

  correctDeltaY(delta) {
    const aspectRatio = this.canvas.width / this.canvas.height;
    if (aspectRatio > 1) delta /= aspectRatio;
    return delta;
  }
  
  generateColor() {
    const c = HSVtoRGB(Math.random(), 1.0, 1.0);
    c.r *= 0.99;
    c.g *= 0.99;
    c.b *= 0.99;
    return c;
  }

  normalizeColor(input) {
    return { r: input.r / 255, g: input.g / 255, b: input.b / 255 };
  }
  
  getResolution(resolution) {
    const aspectRatio = this.gl.drawingBufferWidth / this.gl.drawingBufferHeight;
    const min = Math.round(resolution);
    const max = Math.round(resolution * (aspectRatio < 1 ? 1.0 / aspectRatio : aspectRatio));
    
    return this.gl.drawingBufferWidth > this.gl.drawingBufferHeight
      ? { width: max, height: min }
      : { width: min, height: max };
  }

  scaleByPixelRatio(input) {
    return Math.floor(input * (window.devicePixelRatio || 1));
  }
}



const config = {
    SIM_RESOLUTION: 100,
    DYE_RESOLUTION: 484,
    DENSITY_DISSIPATION: 0.97,
    VELOCITY_DISSIPATION: 0.98,
    PRESSURE: 0.8,
    PRESSURE_ITERATIONS: 5,
    CURL: 4,
    SPLAT_RADIUS: 0.15,
    SPLAT_FORCE: 7000,
    SHADING: true,
    COLORFUL: true,
    COLOR_UPDATE_SPEED: 4,
    PAUSED: false,
    BACK_COLOR: { r: 0, g: 0, b: 0 },
    TRANSPARENT: false,
    SHOW_GUI: true
};


document.addEventListener('DOMContentLoaded', () => {
	
   const canvas = document.getElementById("bannerCanvas");
    
   new FluidSimulation(canvas, config);
    
});
}