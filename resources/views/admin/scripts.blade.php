@extends("admin.layout.app")
@section("content")

<div class="page-header">
  <div class="page-header-left">
    <h1>Custom Scripts</h1>
    <p>Add site-wide scripts that appear on every page, plus per-page/blog overrides set in each section's SEO settings.</p>
  </div>
</div>

<style>
  .script-section { background: var(--card); border-radius: 12px; padding: 24px; margin-bottom: 20px; border: 1px solid var(--border); }
  .script-section h3 { font-size: 15px; font-weight: 700; color: var(--text); margin: 0 0 4px; display: flex; align-items: center; gap: 8px; }
  .script-section h3 i { color: var(--lime); }
  .script-section p { font-size: 12px; color: var(--muted); margin: 0 0 12px; }
  .script-section textarea { width: 100%; min-height: 180px; font-family: 'Courier New', monospace; font-size: 13px; line-height: 1.6; background: #0a0a18; color: #e0e0e0; border: 1px solid var(--border); border-radius: 8px; padding: 14px; outline: none; resize: vertical; }
  .script-section textarea:focus { border-color: var(--lime); }
  .script-section .badge { display: inline-block; background: rgba(223, 248, 17, 0.12); color: var(--lime); font-size: 10px; font-weight: 700; padding: 2px 10px; border-radius: 10px; text-transform: uppercase; letter-spacing: 0.05em; }
</style>

@if(session('success'))
  <div style="background:rgba(72,187,120,0.1);color:#48bb78;padding:12px 20px;border-radius:8px;font-size:14px;margin-bottom:20px;border:1px solid rgba(72,187,120,0.2);">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
  </div>
@endif

<form method="POST" action="{{ route('admin.scripts.update') }}">
  @csrf

  <div class="script-section">
    <h3><i class="fas fa-code"></i> Global Head Script</h3>
    <p>Output inside <code>&lt;head&gt;</code> on EVERY page — before <code>&lt;/head&gt;</code>. Use for Google Analytics, Facebook Pixel, meta tags, etc.</p>
    <div class="badge">Applies to all pages &amp; blogs</div>
    <textarea name="global_head_script" placeholder="&lt;script async src=&quot;https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX&quot;&gt;&lt;/script&gt;&#10;&lt;script&gt;window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-XXXXXXXXXX');&lt;/script&gt;">{{ $settings->global_head_script ?? '' }}</textarea>
  </div>

  <div class="script-section">
    <h3><i class="fas fa-code"></i> Global Body Script</h3>
    <p>Output right after <code>&lt;body&gt;</code> tag on EVERY page. Use for Google Tag Manager (noscript), tracking pixels, etc.</p>
    <div class="badge">Applies to all pages &amp; blogs</div>
    <textarea name="global_body_script" placeholder="&lt;noscript&gt;&lt;iframe src=&quot;https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXX&quot; height=&quot;0&quot; width=&quot;0&quot; style=&quot;display:none;visibility:hidden&quot;&gt;&lt;/iframe&gt;&lt;/noscript&gt;">{{ $settings->global_body_script ?? '' }}</textarea>
  </div>

  <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:24px;">
    <button type="submit" class="btn btn-lime" style="padding:12px 32px;font-size:14px;">
      <i class="fas fa-floppy-disk"></i> Save Global Scripts
    </button>
  </div>

  <div style="background:var(--hover);border-radius:12px;padding:20px;margin-top:16px;border:1px solid var(--border);font-size:13px;color:var(--muted);line-height:1.6;">
    <strong style="color:var(--text);">💡 Per-Page / Per-Blog Scripts</strong><br>
    You can also add page-specific and blog-specific scripts in each section's SEO settings:
    <ul style="margin:6px 0 0 18px;padding:0;">
      <li>Go to <strong>All Pages → [Page Name] → SEO</strong> to set per-page head/body scripts</li>
      <li>Go to <strong>Blog → Create/Edit Blog → SEO Settings</strong> to set per-blog head/body scripts</li>
    </ul>
    Page-specific scripts are output <em>after</em> global scripts (global first, then page-specific).
  </div>
</form>

@endsection
