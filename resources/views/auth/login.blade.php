<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ env('APP_NAME') }} | Login</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .input-field {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid #e2e8f0;
      border-radius: 12px;
      font-size: 14px;
      color: #334155;
      outline: none;
      transition: all 0.2s;
      background: #f8fafc;
    }
    .input-field:focus {
      border-color: #7c3aed;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.12);
    }
    .invalid-feedback {
      color: #ef4444;
      font-size: 12px;
      margin-top: 4px;
      display: block;
    }
  </style>
</head>

<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">

  <div class="w-full max-w-5xl flex rounded-3xl overflow-hidden shadow-2xl bg-white min-h-[560px]">

    <!-- ===== LEFT PANEL - Form ===== -->
    <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">

      <!-- Logo -->
      <div class="mb-8">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-600 to-cyan-400 flex items-center justify-center shadow-lg mb-4">
          <i class="fas fa-bolt text-white text-lg"></i>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Welcome back 👋</h2>
        <p class="text-sm text-slate-400 mt-1">Enter your credentials to access the dashboard</p>
      </div>

      <!-- Error Alert -->
      @if($errors->any())
        <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-600 flex items-center gap-2">
          <i class="fas fa-circle-exclamation"></i>
          {{ $errors->first() }}
        </div>
      @endif

      <!-- Form -->
      <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-1.5">
            Email Address
          </label>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm">
              <i class="fas fa-envelope"></i>
            </span>
            <input
              type="email"
              name="email"
              value="{{ old('email') }}"
              placeholder="admin@example.com"
              required autofocus
              class="input-field pl-10"
            />
          </div>
          @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-1.5">
            Password
          </label>
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm">
              <i class="fas fa-lock"></i>
            </span>
            <input
              type="password"
              name="password"
              placeholder="••••••••"
              required
              class="input-field pl-10"
            />
          </div>
          @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <!-- Remember & Forgot -->
        <div class="flex items-center justify-between">
          <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer select-none">
            <input
              type="checkbox"
              name="remember"
              {{ old('remember') ? 'checked' : '' }}
              class="w-4 h-4 rounded border-gray-300 text-violet-600 focus:ring-violet-400 cursor-pointer"
            />
            Remember me
          </label>
          @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}"
               class="text-sm text-violet-600 hover:text-violet-800 font-medium hover:underline transition">
              Forgot password?
            </a>
          @endif
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          class="w-full py-3 px-6 bg-gradient-to-r from-violet-600 to-cyan-500 text-white font-bold rounded-xl shadow-lg hover:opacity-90 hover:shadow-xl transition-all text-sm tracking-wide mt-2">
          <i class="fas fa-sign-in-alt mr-2"></i> Sign In
        </button>

      </form>

    </div>

    <!-- ===== RIGHT PANEL - Decorative ===== -->
    <div class="hidden md:flex md:w-1/2 relative bg-gradient-to-br from-violet-600 via-purple-600 to-cyan-500 items-center justify-center overflow-hidden">

      <!-- Background circles decoration -->
      <div class="absolute w-72 h-72 bg-white/10 rounded-full -top-16 -right-16"></div>
      <div class="absolute w-48 h-48 bg-white/10 rounded-full bottom-10 -left-10"></div>
      <div class="absolute w-32 h-32 bg-white/5 rounded-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>

      <!-- Content -->
      <div class="relative z-10 text-center px-10">
        <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-3xl flex items-center justify-center backdrop-blur-sm">
          <i class="fas fa-shield-halved text-white text-4xl"></i>
        </div>
        <h3 class="text-white text-2xl font-bold mb-3">Secure Admin Panel</h3>
        <p class="text-white/70 text-sm leading-relaxed">
          Manage your website content, pages, queries, and settings from one place.
        </p>

        <!-- Stats -->
        <div class="flex justify-center gap-6 mt-8">
          <div class="text-center">
            <p class="text-white text-xl font-bold">100%</p>
            <p class="text-white/60 text-xs">Secure</p>
          </div>
          <div class="w-px bg-white/20"></div>
          <div class="text-center">
            <p class="text-white text-xl font-bold">24/7</p>
            <p class="text-white/60 text-xs">Access</p>
          </div>
          <div class="w-px bg-white/20"></div>
          <div class="text-center">
            <p class="text-white text-xl font-bold">Fast</p>
            <p class="text-white/60 text-xs">Dashboard</p>
          </div>
        </div>
      </div>

    </div>
    <!-- ===== END RIGHT PANEL ===== -->

  </div>

</body>
</html>