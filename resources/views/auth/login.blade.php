<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ env('APP_NAME') }} | Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #0d0b1a;
      --sidebar: #100e1f;
      --card: #17142e;
      --hover: #1e1a38;
      --lime: #dff811;
      --teal: #67fcc6;
      --purple: #7c3aed;
      --text: #ffffff;
      --muted: #a09bb5;
      --danger: #ff6b81;
      --border: #ffffff12;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #07051a;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      position: relative;
      overflow: hidden;
    }

    /* ── ANIMATED BG ── */
    .bg-scene {
      position: fixed;
      inset: 0;
      z-index: 0;
      overflow: hidden;
    }

    .bg-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      animation: orbFloat 12s ease-in-out infinite alternate;
    }

    .bg-orb-1 {
      width: 500px; height: 500px;
      background: rgba(124, 58, 237, 0.25);
      top: -150px; left: -100px;
      animation-duration: 14s;
    }

    .bg-orb-2 {
      width: 400px; height: 400px;
      background: rgba(103, 252, 198, 0.12);
      bottom: -120px; right: -80px;
      animation-duration: 10s;
      animation-delay: -4s;
    }

    .bg-orb-3 {
      width: 300px; height: 300px;
      background: rgba(223, 248, 17, 0.08);
      top: 40%; left: 50%;
      transform: translate(-50%, -50%);
      animation-duration: 18s;
      animation-delay: -8s;
    }

    .bg-orb-4 {
      width: 200px; height: 200px;
      background: rgba(124, 58, 237, 0.18);
      bottom: 10%; left: 20%;
      animation-duration: 16s;
      animation-delay: -2s;
    }

    /* Grid lines overlay */
    .bg-grid {
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
      background-size: 48px 48px;
    }

    @keyframes orbFloat {
      0%   { transform: translate(0, 0) scale(1); }
      33%  { transform: translate(30px, -40px) scale(1.08); }
      66%  { transform: translate(-20px, 20px) scale(0.95); }
      100% { transform: translate(10px, -20px) scale(1.04); }
    }

    .login-wrapper {
      width: 100%;
      max-width: 960px;
      min-height: 560px;
      display: flex;
      border-radius: 24px;
      overflow: hidden;
      position: relative;
      z-index: 1;
      box-shadow: 0 40px 100px rgba(0,0,0,0.7), 0 0 0 1px rgba(255,255,255,0.06);
    }

    /* ── LEFT PANEL — GLASS ── */
    .left-panel {
      flex: 1;
      background: rgba(23, 20, 46, 0.75);
      backdrop-filter: blur(28px);
      -webkit-backdrop-filter: blur(28px);
      border-right: 1px solid rgba(255,255,255,0.07);
      padding: 48px 44px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .logo-row {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 36px;
    }

    .logo-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: var(--lime);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo-icon i {
      color: #0d0b1a;
      font-size: 18px;
    }

    .logo-text h1 {
      font-family: 'Manrope', sans-serif;
      font-size: 18px;
      font-weight: 800;
      color: var(--text);
      line-height: 1;
    }

    .logo-text p {
      font-size: 11px;
      color: var(--muted);
      margin-top: 2px;
      letter-spacing: 0.05em;
    }

    .form-heading {
      margin-bottom: 28px;
    }

    .form-heading h2 {
      font-family: 'Manrope', sans-serif;
      font-size: 26px;
      font-weight: 800;
      color: var(--text);
      margin-bottom: 6px;
    }

    .form-heading p {
      font-size: 14px;
      color: var(--muted);
    }

    .alert-error {
      background: rgba(255, 107, 129, 0.12);
      border: 1px solid rgba(255, 107, 129, 0.3);
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 13px;
      color: var(--danger);
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--muted);
      margin-bottom: 8px;
      letter-spacing: 0.02em;
    }

    .input-wrap {
      position: relative;
    }

    .input-wrap i.icon-left {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 14px;
      pointer-events: none;
    }

    .input-wrap input {
      width: 100%;
      background: var(--hover);
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 12px 14px 12px 40px;
      font-size: 14px;
      color: var(--text);
      font-family: 'Inter', sans-serif;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .input-wrap input::placeholder { color: #4a4568; }

    .input-wrap input:focus {
      border-color: var(--lime);
      box-shadow: 0 0 0 3px rgba(223, 248, 17, 0.12);
    }

    .input-wrap .toggle-eye {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: var(--muted);
      font-size: 14px;
      padding: 0;
      transition: color 0.2s;
    }

    .input-wrap .toggle-eye:hover { color: var(--text); }

    .invalid-feedback {
      display: block;
      font-size: 12px;
      color: var(--danger);
      margin-top: 6px;
    }

    .remember-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
    }

    .remember-label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--muted);
      cursor: pointer;
    }

    .remember-label input[type="checkbox"] {
      width: 16px;
      height: 16px;
      accent-color: var(--lime);
      cursor: pointer;
    }

    .btn-signin {
      width: 100%;
      padding: 14px;
      background: var(--lime);
      color: #0d0b1a;
      font-family: 'Manrope', sans-serif;
      font-size: 14px;
      font-weight: 800;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      letter-spacing: 0.03em;
      transition: opacity 0.2s, transform 0.1s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-signin:hover { opacity: 0.9; transform: translateY(-1px); }
    .btn-signin:active { transform: translateY(0); }

    /* ── RIGHT PANEL — GLASS ── */
    .right-panel {
      width: 420px;
      background: rgba(15, 10, 40, 0.55);
      backdrop-filter: blur(28px);
      -webkit-backdrop-filter: blur(28px);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 48px 40px;
      position: relative;
      overflow: hidden;
    }

    /* inner glow rings inside right panel */
    .blob {
      position: absolute;
      border-radius: 50%;
      background: rgba(124, 58, 237, 0.18);
      filter: blur(40px);
    }

    .blob-1 { width: 260px; height: 260px; top: -60px; right: -60px; }
    .blob-2 { width: 160px; height: 160px; bottom: 20px; left: -40px; background: rgba(103,252,198,0.12); }
    .blob-3 { width: 100px; height: 100px; top: 50%; left: 50%; transform: translate(-50%,-50%); background: rgba(223,248,17,0.06); }

    /* glass card inside right panel */
    .right-glass {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 20px;
      padding: 36px 32px;
      position: relative;
      z-index: 2;
      backdrop-filter: blur(10px);
      text-align: center;
      width: 100%;
    }

    .right-content {
      position: relative;
      z-index: 2;
      text-align: center;
      width: 100%;
    }

    .shield-wrap {
      width: 88px;
      height: 88px;
      background: rgba(223, 248, 17, 0.1);
      border-radius: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 28px;
      border: 1px solid rgba(223, 248, 17, 0.2);
    }

    .shield-wrap i { font-size: 36px; color: var(--lime); }

    .right-content h3 {
      font-family: 'Manrope', sans-serif;
      font-size: 22px;
      font-weight: 800;
      color: var(--text);
      margin-bottom: 12px;
    }

    .right-content p {
      font-size: 13px;
      color: var(--muted);
      line-height: 1.7;
      max-width: 280px;
      margin: 0 auto 36px;
    }

    .stats-row {
      display: flex;
      align-items: center;
      gap: 24px;
      justify-content: center;
    }

    .stat-item { text-align: center; }

    .stat-item .val {
      font-family: 'Manrope', sans-serif;
      font-size: 20px;
      font-weight: 800;
      color: var(--lime);
    }

    .stat-item .key {
      font-size: 11px;
      color: var(--muted);
      margin-top: 2px;
    }

    .stat-divider {
      width: 1px;
      height: 36px;
      background: rgba(255,255,255,0.1);
    }

    .dots-row {
      display: flex;
      gap: 6px;
      justify-content: center;
      margin-top: 40px;
    }

    .dot {
      width: 6px; height: 6px;
      border-radius: 50%;
      background: rgba(255,255,255,0.2);
    }

    .dot.active { background: var(--lime); width: 20px; border-radius: 3px; }

    @media (max-width: 768px) {
      .right-panel { display: none; }
      .left-panel { padding: 36px 28px; }
    }
  </style>
</head>
<body>

<!-- ANIMATED BACKGROUND -->
<div class="bg-scene">
  <div class="bg-grid"></div>
  <div class="bg-orb bg-orb-1"></div>
  <div class="bg-orb bg-orb-2"></div>
  <div class="bg-orb bg-orb-3"></div>
  <div class="bg-orb bg-orb-4"></div>
</div>

<div class="login-wrapper">

  <!-- LEFT: FORM -->
  <div class="left-panel">

    <div class="logo-row">
      <div class="logo-icon">
        <i class="fas fa-bolt"></i>
      </div>
      <div class="logo-text">
        <h1>TSA Admin</h1>
        <p>THE NOCTURNAL ARCHITECT</p>
      </div>
    </div>

    <div class="form-heading">
      <h2>Welcome back 👋</h2>
      <p>Sign in to access your dashboard</p>
    </div>

    @if($errors->any())
      <div class="alert-error">
        <i class="fas fa-circle-exclamation"></i>
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="form-group">
        <label>Email Address</label>
        <div class="input-wrap">
          <i class="fas fa-envelope icon-left"></i>
          <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus />
        </div>
        @error('email')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label>Password</label>
        <div class="input-wrap">
          <i class="fas fa-lock icon-left"></i>
          <input type="password" name="password" id="password" placeholder="••••••••" required />
          <button type="button" class="toggle-eye" onclick="togglePassword()">
            <i class="fas fa-eye" id="eye-icon"></i>
          </button>
        </div>
        @error('password')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="remember-row">
        <label class="remember-label">
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
          Remember me
        </label>
      </div>

      <button type="submit" class="btn-signin">
        <i class="fas fa-sign-in-alt"></i> Sign In
      </button>

    </form>
  </div>

  <!-- RIGHT: DECORATIVE -->
  <div class="right-panel">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="right-content">
      <div class="right-glass">
        <div class="shield-wrap">
          <i class="fas fa-shield-halved"></i>
        </div>
        <h3>Secure Admin Panel</h3>
        <p>Manage your website content, pages, queries, and settings all from one place.</p>

        <div class="stats-row">
          <div class="stat-item">
            <div class="val">100%</div>
            <div class="key">Secure</div>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <div class="val">24/7</div>
            <div class="key">Access</div>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <div class="val">Fast</div>
            <div class="key">Dashboard</div>
          </div>
        </div>

        <div class="dots-row">
          <div class="dot active"></div>
          <div class="dot"></div>
          <div class="dot"></div>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('eye-icon');
    if (input.type === 'password') {
      input.type = 'text';
      icon.className = 'fas fa-eye-slash';
    } else {
      input.type = 'password';
      icon.className = 'fas fa-eye';
    }
  }
</script>

</body>
</html>