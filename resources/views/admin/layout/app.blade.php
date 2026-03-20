@if(env("SITE_SETTING"))
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin {{ env('APP_Name') }}</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <!-- Tailwind CSS CDN (no installation needed) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
          },
          colors: {
            primary: {
              50:  '#f5f3ff',
              100: '#ede9fe',
              500: '#8b5cf6',
              600: '#7c3aed',
              700: '#6d28d9',
              800: '#5b21b6',
            }
          },
          transitionDuration: {
            '250': '250ms',
          }
        }
      }
    }
  </script>

  <style>
    /* Sidebar transition */
    #sidenav-main {
      transition: transform 0.3s ease;
    }
    /* Active nav item */
    .nav-link.active {
      background: linear-gradient(to right, #7c3aed, #db2777);
      color: white !important;
    }
    .nav-link.active span { color: white !important; }
    .nav-link.active .nav-icon {
      background: rgba(255,255,255,0.2) !important;
    }
    /* Scrollbar */
    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #c4b5fd; border-radius: 4px; }
    a { text-decoration: none; }
    .form-control {
      border: 1px solid rgba(0,0,0,0.2);
      border-radius: 0.5rem;
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      font-size: 15px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      outline: none;
      transition: border-color 0.2s;
    }
    .form-control:focus {
      border-color: #7c3aed;
      box-shadow: 0 0 0 3px rgba(124,58,237,0.15);
    }
  </style>
</head>

<body class="m-0 font-sans text-sm antialiased bg-gray-100 text-slate-600">

  <!-- ===== SIDEBAR ===== -->
  <aside id="sidenav-main"
    class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 m-3 bg-white rounded-2xl shadow-xl overflow-hidden
           -translate-x-full xl:translate-x-0 transition-transform duration-300">

    <!-- Logo -->
    <div class="px-6 py-5 border-b border-gray-100">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-600 to-pink-500 flex items-center justify-center shadow-md">
          <i class="fas fa-bolt text-white text-sm"></i>
        </div>
        <span class="font-bold text-slate-800 text-base tracking-tight">{{ env('APP_Name') }}</span>
      </a>
    </div>

    <!-- Nav Links -->
    <nav class="flex-1 px-3 py-4 overflow-y-auto space-y-1">

      <p class="px-3 pt-2 pb-1 text-xs font-semibold text-slate-400 uppercase tracking-widest">Menu</p>

      <a href="{{ route('admin.page') }}"
         class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 font-medium hover:bg-violet-50 hover:text-violet-700 transition-all group">
        <span class="nav-icon w-8 h-8 flex items-center justify-center rounded-lg bg-gradient-to-br from-violet-600 to-pink-500 shadow-sm group-hover:shadow-md transition-all">
          <i class="fas fa-file-alt text-white text-xs"></i>
        </span>
        <span>Pages</span>
      </a>

      <a href="{{ route('admin.profile') }}"
         class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 font-medium hover:bg-violet-50 hover:text-violet-700 transition-all group">
        <span class="nav-icon w-8 h-8 flex items-center justify-center rounded-lg bg-gradient-to-br from-violet-600 to-pink-500 shadow-sm group-hover:shadow-md transition-all">
          <i class="fas fa-user text-white text-xs"></i>
        </span>
        <span>Profile</span>
      </a>

      <a href="{{ route('admin.query') }}"
         class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 font-medium hover:bg-violet-50 hover:text-violet-700 transition-all group">
        <span class="nav-icon w-8 h-8 flex items-center justify-center rounded-lg bg-gradient-to-br from-violet-600 to-pink-500 shadow-sm group-hover:shadow-md transition-all">
          <i class="fas fa-envelope-open-text text-white text-xs"></i>
        </span>
        <span>Query</span>
      </a>

    </nav>

    <!-- Sidebar Footer -->
    <div class="px-4 py-4 border-t border-gray-100">
      <div class="flex items-center gap-3 px-2">
        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-violet-500 to-pink-400 flex items-center justify-center">
          <i class="fas fa-user-tie text-white text-xs"></i>
        </div>
        <div>
          <p class="text-xs font-semibold text-slate-700">Administrator</p>
          <p class="text-xs text-slate-400">Logged in</p>
        </div>
      </div>
    </div>
  </aside>

  <!-- Overlay for mobile -->
  <div id="sidenav-overlay"
       class="fixed inset-0 z-40 bg-black/40 hidden xl:hidden"
       onclick="closeSidebar()"></div>

  <!-- ===== MAIN CONTENT ===== -->
  <div class="xl:ml-[calc(16rem+1.5rem)] min-h-screen flex flex-col">

    <!-- ===== NAVBAR ===== -->
    <nav class="sticky top-0 z-30 mx-4 mt-4">
      <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-sm border border-white px-5 py-3 flex items-center justify-between">

        <!-- Mobile menu button -->
        <button onclick="toggleSidebar()"
                class="xl:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-violet-100 text-slate-600 hover:text-violet-600 transition-all">
          <i class="fas fa-bars text-sm"></i>
        </button>

        <!-- Page title (breadcrumb area) -->
        <div class="hidden xl:flex items-center gap-2 text-sm text-slate-500">
          <i class="fas fa-home text-xs text-violet-400"></i>
          <span>/</span>
          <span class="font-medium text-slate-700">Dashboard</span>
        </div>

        <!-- Right side actions -->
        <div class="flex items-center gap-3 ml-auto">

          <!-- Notification bell -->
          <button class="relative w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-violet-100 text-slate-500 hover:text-violet-600 transition-all">
            <i class="fas fa-bell text-sm"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-pink-500 rounded-full border border-white"></span>
          </button>

          <!-- Logout -->
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-violet-600 to-pink-500 text-white text-xs font-semibold shadow-md hover:shadow-lg hover:opacity-90 transition-all">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </button>
          </form>

        </div>
      </div>
    </nav>
    <!-- ===== END NAVBAR ===== -->

    <!-- ===== PAGE CONTENT ===== -->
    <main class="flex-1 p-4">
      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="px-6 py-4 text-center text-xs text-slate-400">
      © {{ date('Y') }} {{ env('APP_Name') }} &mdash; Admin Panel
    </footer>

  </div>
  <!-- ===== END MAIN CONTENT ===== -->

  <!-- Scripts -->
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidenav-main');
      const overlay = document.getElementById('sidenav-overlay');
      sidebar.classList.toggle('-translate-x-full');
      overlay.classList.toggle('hidden');
    }
    function closeSidebar() {
      document.getElementById('sidenav-main').classList.add('-translate-x-full');
      document.getElementById('sidenav-overlay').classList.add('hidden');
    }

    // Highlight active nav link
    document.querySelectorAll('.nav-link').forEach(link => {
      if (link.href === window.location.href) {
        link.classList.add('active');
      }
    });
  </script>

  <!-- Rich Text Editor -->
  <script type="text/javascript" src="/assets/texteditor/richtexteditor/rte.js"></script>
  <script type="text/javascript" src="/assets/texteditor/richtexteditor/plugins/all_plugins.js"></script>
  <link rel="stylesheet" href="/assets/texteditor/richtexteditor/rte_theme_default.css" />

  @stack('scripts')

</body>
</html>
@else
  {{ abort(404) }}
@endif