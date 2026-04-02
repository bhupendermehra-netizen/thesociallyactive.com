<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TSA | Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-J8FS8NYVR4"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-J8FS8NYVR4');
  </script>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #0d0b1a;
      --sidebar: #100e1f;
      --card: #17142e;
      --hover: #1e1a38;
      --lime: #dff811;
      --teal: #67fcc6;
      --text: #ffffff;
      --muted: #a09bb5;
      --danger: #ff6b81;
      --border: #ffffff08;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ─── SIDEBAR ─── */
    .sidebar {
      width: 230px;
      height: 100vh;
      background: var(--sidebar);
      position: fixed;
      top: 0; left: 0;
      display: flex;
      flex-direction: column;
      z-index: 200;
      transition: transform 0.3s ease;
      border-right: 1px solid var(--border);
      overflow: hidden;
    }

    /* TOP: logo — fixed */
    .sidebar-logo {
      padding: 24px 20px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-bottom: 1px solid var(--border);
      flex-shrink: 0;
    }

    /* MIDDLE: nav items — scrollable */
    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
    }

    .sidebar-nav::-webkit-scrollbar { width: 3px; }
    .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }
    .sidebar-nav::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }

    /* BOTTOM: user + logout — fixed */
    .sidebar-footer {
      flex-shrink: 0;
      border-top: 1px solid var(--border);
    }

    .logo-icon {
      width: 38px; height: 38px;
      background: var(--lime);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }

    .logo-icon i { color: #0d0b1a; font-size: 16px; }

    .logo-text span {
      font-family: 'Manrope', sans-serif;
      font-size: 15px;
      font-weight: 800;
      color: var(--text);
      display: block;
      line-height: 1.1;
    }

    .logo-text small {
      font-size: 9px;
      color: var(--muted);
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .nav-label {
      font-size: 10px;
      font-weight: 700;
      color: var(--muted);
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 20px 20px 8px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 11px 20px;
      color: var(--muted);
      text-decoration: none;
      font-size: 13.5px;
      font-weight: 500;
      border-left: 3px solid transparent;
      transition: all 0.2s;
      margin: 1px 0;
    }

    .nav-item:hover { color: var(--text); background: var(--hover); }

    .nav-item.active {
      color: var(--text);
      background: var(--hover);
      border-left-color: var(--lime);
    }

    .nav-item.active .nav-icon { color: var(--lime); }

    .nav-icon {
      width: 32px; height: 32px;
      border-radius: 8px;
      background: rgba(255,255,255,0.06);
      display: flex; align-items: center; justify-content: center;
      font-size: 13px;
      flex-shrink: 0;
      transition: background 0.2s;
    }

    .nav-item:hover .nav-icon,
    .nav-item.active .nav-icon { background: rgba(223, 248, 17, 0.12); }

    .user-row {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 16px 20px;
    }

    .user-avatar {
      width: 36px; height: 36px;
      background: linear-gradient(135deg, var(--lime), var(--teal));
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 13px;
      font-weight: 700;
      color: #0d0b1a;
      flex-shrink: 0;
    }

    .user-info span {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--text);
      line-height: 1.2;
    }

    .user-info small { font-size: 11px; color: var(--muted); }

    .btn-logout {
      display: flex;
      align-items: center;
      gap: 10px;
      width: calc(100% - 24px);
      margin: 0 12px 16px;
      padding: 10px 16px;
      background: rgba(255, 107, 129, 0.08);
      color: var(--danger);
      border: 1px solid rgba(255, 107, 129, 0.2);
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: background 0.2s;
      text-decoration: none;
    }

    .btn-logout:hover { background: rgba(255, 107, 129, 0.15); }

    /* ─── MAIN CONTENT ─── */
    .main-content {
      margin-left: 230px;
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background: var(--bg);
    }

    /* ─── NAVBAR ─── */
    .admin-navbar {
      position: sticky;
      top: 0;
      z-index: 100;
      background: rgba(13, 11, 26, 0.85);
      backdrop-filter: blur(12px);
      padding: 0 28px;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid var(--border);
      flex-shrink: 0;
    }

    .navbar-left { display: flex; align-items: center; gap: 12px; }

    #hamburger-btn {
      display: none;
      background: none;
      border: none;
      color: var(--text);
      font-size: 18px;
      cursor: pointer;
      padding: 6px 8px;
      border-radius: 8px;
    }

    #hamburger-btn:hover { background: var(--hover); }

    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--muted);
    }

    .breadcrumb a { color: var(--muted); text-decoration: none; }
    .breadcrumb span { color: var(--lime); font-weight: 600; }
    .breadcrumb i { font-size: 10px; }

    .navbar-right { display: flex; align-items: center; gap: 10px; }

    .nav-btn {
      width: 36px; height: 36px;
      border-radius: 10px;
      background: var(--card);
      border: 1px solid var(--border);
      color: var(--muted);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      font-size: 15px;
      transition: all 0.2s;
      text-decoration: none;
    }

    .nav-btn:hover { background: var(--hover); color: var(--text); }

    #theme-toggle {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 10px;
      width: 36px; height: 36px;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.2s;
    }
    #theme-toggle:hover { background: var(--hover); }

    /* ─── PAGE CONTENT ─── */
    .page-content { padding: 28px; flex: 1; }

    /* ─── CARDS ─── */
    .tsa-card {
      background: var(--card);
      border-radius: 16px;
      padding: 24px;
      margin-bottom: 24px;
    }

    .tsa-card-title {
      font-family: 'Manrope', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    /* ─── TABLES ─── */
    .tsa-table { width: 100%; border-collapse: collapse; }
    .tsa-table thead th {
      font-size: 11px; font-weight: 700; color: var(--muted);
      text-transform: uppercase; letter-spacing: 0.08em;
      padding: 0 16px 14px; text-align: left;
      border-bottom: 1px solid var(--border);
    }
    .tsa-table tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
    .tsa-table tbody tr:hover { background: var(--hover); }
    .tsa-table tbody tr:last-child { border-bottom: none; }
    .tsa-table td { padding: 14px 16px; font-size: 13.5px; color: var(--text); vertical-align: middle; }
    .tsa-table td.muted { color: var(--muted); font-size: 12px; }

    /* ─── BUTTONS ─── */
    .btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: opacity 0.2s; font-family: 'Inter', sans-serif; }
    .btn:hover { opacity: 0.85; }
    .btn-lime { background: var(--lime); color: #0d0b1a; }
    .btn-teal { background: rgba(103,252,198,0.12); color: var(--teal); border: 1px solid rgba(103,252,198,0.25); }
    .btn-red  { background: rgba(255,107,129,0.12); color: var(--danger); border: 1px solid rgba(255,107,129,0.25); }
    .btn-ghost { background: var(--hover); color: var(--muted); }

    /* ─── FORMS ─── */
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 12px; font-weight: 600; color: var(--muted); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em; }
    .form-control { width: 100%; background: var(--hover); border: 1.5px solid var(--border); border-radius: 10px; padding: 11px 14px; font-size: 14px; color: var(--text); font-family: 'Inter', sans-serif; outline: none; transition: border-color 0.2s; }
    .form-control:focus { border-color: var(--lime); box-shadow: 0 0 0 3px rgba(223,248,17,0.1); }
    .form-control::placeholder { color: #4a4568; }
    textarea.form-control { resize: vertical; min-height: 90px; }
    select.form-control option { background: var(--card); }

    /* ─── BADGES ─── */
    .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .badge-lime { background: rgba(223,248,17,0.12); color: var(--lime); }
    .badge-teal { background: rgba(103,252,198,0.12); color: var(--teal); }
    .badge-red  { background: rgba(255,107,129,0.12); color: var(--danger); }
    .badge-muted{ background: rgba(160,155,181,0.12); color: var(--muted); }

    /* ─── OVERLAY ─── */
    #sidebar-overlay {
      display: none;
      position: fixed; inset: 0;
      background: rgba(0,0,0,0.6);
      z-index: 199;
    }

    /* ─── LIGHT MODE ─── */
    html.light-mode {
      --bg: #f0eef8; --card: #ffffff; --hover: #ede9ff;
      --text: #0d0b1a; --muted: #5a5278; --border: #0000001a;
    }
    html.light-mode .sidebar { background: #1a1730; }
    html.light-mode .sidebar .nav-item { color: #a09bb5; }
    html.light-mode .sidebar .nav-item:hover,
    html.light-mode .sidebar .nav-item.active { color: #fff; }
    html.light-mode .sidebar .nav-label { color: #6b6488; }
    html.light-mode .sidebar .logo-text span { color: #fff; }
    html.light-mode .sidebar .logo-text small { color: #a09bb5; }
    html.light-mode .sidebar .user-info span { color: #fff; }
    html.light-mode .sidebar .user-info small { color: #a09bb5; }
    html.light-mode .sidebar-footer { border-top-color: #ffffff10; }
    html.light-mode .sidebar-logo { border-bottom-color: #ffffff10; }
    html.light-mode .main-content { background: #f0eef8; }
    html.light-mode .admin-navbar { background: rgba(240,238,248,0.9); border-bottom-color: #0000001a; }
    html.light-mode .breadcrumb a { color: #5a5278; }
    html.light-mode #theme-toggle { background: #fff; border-color: #0000001a; color: #5a5278; }
    html.light-mode .tsa-card { background: #ffffff; box-shadow: 0 1px 4px rgba(0,0,0,0.07); }
    html.light-mode .tsa-card-title { color: #0d0b1a; }
    html.light-mode .tsa-table thead th { color: #5a5278; border-bottom-color: #0000001a; }
    html.light-mode .tsa-table tbody tr { border-bottom-color: #0000000d; color: #0d0b1a; }
    html.light-mode .tsa-table tbody tr:hover { background: #ede9ff; }
    html.light-mode .tsa-table td { color: #0d0b1a; }
    html.light-mode .tsa-table td.muted { color: #5a5278; }
    html.light-mode .form-control { background: #f5f3ff; border-color: #0000001a; color: #0d0b1a; }
    html.light-mode .form-control:focus { border-color: #7c3aed; background: #fff; }
    html.light-mode .form-control::placeholder { color: #9990bc; }
    html.light-mode .form-group label { color: #5a5278; }
    html.light-mode select.form-control option { background: #fff; color: #0d0b1a; }
    html.light-mode .btn-ghost { background: #ede9ff; color: #5a5278; }
    html.light-mode .btn-ghost:hover { background: #ddd8f8; }
    html.light-mode .nav-btn { background: #fff; border-color: #0000001a; color: #5a5278; }
    html.light-mode .badge-muted { background: #ede9ff; color: #5a5278; }
    html.light-mode .badge-lime  { background: #f0ffd0; color: #5a7a00; }
    html.light-mode .badge-teal  { background: #d0fff2; color: #0a6b50; }
    html.light-mode .badge-red   { background: #ffe0e5; color: #c0002a; }
    html.light-mode .page-content { color: #0d0b1a; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 991px) {
      .sidebar { transform: translateX(-100%); }
      .sidebar.open { transform: translateX(0); }
      #sidebar-overlay.show { display: block; }
      .main-content { margin-left: 0; }
      #hamburger-btn { display: flex; align-items: center; justify-content: center; }
      .page-content { padding: 20px 16px; }
    }
    @media (max-width: 480px) {
      .admin-navbar { padding: 0 16px; }
    }
  </style>
  @yield('styles')
</head>
<body>

<div id="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- ─── SIDEBAR ─── -->
<aside class="sidebar" id="sidebar">

  <!-- LOGO — fixed top -->
  <div class="sidebar-logo">
    <div class="logo-icon"><i class="fas fa-bolt"></i></div>
    <div class="logo-text">
      <span>TSA Admin</span>
      <small>The Nocturnal Architect</small>
    </div>
  </div>

  <!-- NAV — scrollable middle -->
  <div class="sidebar-nav">
    <div class="nav-label">Menu</div>

    <a href="{{ route('admin.dashboard') }}"
       class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
      <span class="nav-icon"><i class="fas fa-gauge-high"></i></span>
      Dashboard
    </a>

    <a href="{{ route('admin.page') }}"
       class="nav-item {{ Request::is('admin/page') ? 'active' : '' }}">
      <span class="nav-icon"><i class="fas fa-file-lines"></i></span>
      All Pages
    </a>

    <div class="nav-label">Home Sections</div>

    <a href="{{ route('admin.page.edit', 14) }}"
       class="nav-item {{ Request::is('admin/page/edit/14') ? 'active' : '' }}">
      <span class="nav-icon"><i class="fas fa-house"></i></span>
      Home Banner
    </a>
    <a href="{{ route('admin.projects.index') }}"
     class="nav-item {{ Request::is('admin/projects*') ? 'active' : '' }}">
    <span class="nav-icon"><i class="fas fa-briefcase"></i></span>
    Projects
  </a>
 <a href="{{ route('admin.blog.index') }}"
   class="nav-item {{ Request::is('admin/blog') ? 'active' : '' }}">
  <span class="nav-icon"><i class="fas fa-newspaper"></i></span>
  Blog
</a>

    <a href="{{ route('admin.page.edit', 27) }}"
       class="nav-item {{ Request::is('admin/page/edit/27') ? 'active' : '' }}">
      <span class="nav-icon"><i class="fas fa-quote-left"></i></span>
      Testimonials
    </a>

    <a href="{{ route('admin.page.edit', 25) }}"
       class="nav-item {{ Request::is('admin/page/edit/25') ? 'active' : '' }}">
      <span class="nav-icon"><i class="fas fa-briefcase"></i></span>
      Brands
    </a>

    <div class="nav-label">System</div>

    <a href="{{ route('admin.query') }}"
       class="nav-item {{ Request::is('admin/query*') ? 'active' : '' }}">
      <span class="nav-icon"><i class="fas fa-inbox"></i></span>
      Queries
    </a>

    <a href="{{ route('admin.profile') }}"
       class="nav-item {{ Request::is('admin/profile*') ? 'active' : '' }}">
      <span class="nav-icon"><i class="fas fa-user-circle"></i></span>
      Profile
    </a>
  </div>

  <!-- FOOTER — fixed bottom -->
  <div class="sidebar-footer">
    <div class="user-row">
      <div class="user-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
      <div class="user-info">
        <span>{{ Auth::user()->name ?? 'Administrator' }}</span>
        <small>Logged in</small>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn-logout">
        <i class="fas fa-right-from-bracket"></i> Logout
      </button>
    </form>
  </div>

</aside>

<!-- ─── MAIN ─── -->
<div class="main-content" id="main-content">

  <nav class="admin-navbar">
    <div class="navbar-left">
      <button id="hamburger-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
      </button>
      <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-house"></i></a>
        <i class="fas fa-chevron-right"></i>
        <span>@yield('page-title', 'Dashboard')</span>
      </div>
    </div>
    <div class="navbar-right">
      <button id="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
        <span id="theme-icon">🌙</span>
      </button>
    </div>
  </nav>

  <div class="page-content">
    @yield('content')
  </div>

</div>

<script>
  (function() {
    if (localStorage.getItem('tsa-theme') === 'light') {
      document.documentElement.classList.add('light-mode');
      const icon = document.getElementById('theme-icon');
      if (icon) icon.textContent = '☀️';
    }
  })();

  function toggleTheme() {
    const html = document.documentElement;
    const icon = document.getElementById('theme-icon');
    if (html.classList.contains('light-mode')) {
      html.classList.remove('light-mode');
      localStorage.setItem('tsa-theme', 'dark');
      if (icon) icon.textContent = '🌙';
    } else {
      html.classList.add('light-mode');
      localStorage.setItem('tsa-theme', 'light');
      if (icon) icon.textContent = '☀️';
    }
  }

  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    sidebar.classList.toggle('open');
    overlay.classList.toggle('show');
    document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
  }

  window.addEventListener('resize', function() {
    if (window.innerWidth >= 992) {
      const s = document.getElementById('sidebar');
      const o = document.getElementById('sidebar-overlay');
      if (s) s.classList.remove('open');
      if (o) o.classList.remove('show');
      document.body.style.overflow = '';
    }
  });
</script>

@yield('scripts')
</body>
</html>