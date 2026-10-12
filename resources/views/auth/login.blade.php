<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SMAKNIS Sistem Kantin Digital</title>

    <!-- Tailwind CSS (Vite Laravel) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F6EFE9] font-sans antialiased text-gray-800 min-h-screen flex items-center justify-center p-4 sm:p-6 relative overflow-x-hidden">

    <!-- Pattern Background Decoration (Doodle Makanan Transparan) -->
    <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#d97706_1px,transparent_1px)] [background-size:20px_20px]"></div>

    <!-- Main Wrapper (Responsive Container) -->
    <div class="w-full max-w-md mx-auto flex flex-col items-center justify-center relative z-10 space-y-6">
        
        <!-- Logo & Branding Section -->
        <div class="text-center flex flex-col items-center">
            <div class="bg-gradient-to-tr from-amber-600 to-orange-500 p-3.5 rounded-3xl text-white shadow-lg shadow-orange-500/20 mb-3 flex items-center justify-center">
                <!-- Icon Sendok & Garpu / Kantin -->
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-black text-[#3E2723] tracking-wider uppercase">SMAKNIS</h1>
            <p class="text-xs text-amber-800/70 font-semibold tracking-wide">Sistem Kantin Digital</p>
        </div>

        <!-- Login Card Form -->
        <div class="w-full bg-white/90 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-xl shadow-amber-900/5 border border-amber-100">
            
            <div class="text-center mb-6">
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#3E2723]">Selamat Datang!</h2>
                <p class="text-xs text-gray-500 mt-1">Silakan masuk ke akun Anda.</p>
            </div>

            <!-- Session Status Alert (Jika ada status dari session) -->
            @if (session('status'))
                <div class="mb-4 text-xs font-medium text-emerald-700 bg-emerald-50 p-3 rounded-2xl border border-emerald-200">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form Autentikasi Login -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                            class="w-full bg-white border border-gray-300 text-xs rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition shadow-sm"
                            placeholder="nama@email.com">
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-[11px] text-red-500 mt-1 block font-medium">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-xs font-bold text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[11px] text-orange-600 hover:text-orange-700 font-semibold transition">
                                Lupa Password?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </span>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="w-full bg-white border border-gray-300 text-xs rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition shadow-sm"
                            placeholder="••••••••">
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-[11px] text-red-500 mt-1 block font-medium">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center space-x-2 pt-1">
                    <input type="checkbox" id="remember_me" name="remember" class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500 w-4 h-4 cursor-pointer">
                    <label for="remember_me" class="text-xs text-gray-600 font-medium cursor-pointer select-none">Remember me</label>
                </div>

                <!-- Tombol Submit Login -->
                <button type="submit" class="w-full bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 text-white font-bold text-xs py-3.5 rounded-xl shadow-md shadow-orange-600/20 hover:shadow-lg transition duration-200 active:scale-[0.99] mt-2">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>

        <!-- Info Akun Demo (Bawah Card) -->
        <div class="w-full bg-amber-100/50 backdrop-blur-sm border border-amber-200/70 rounded-2xl p-4 text-[11px] text-amber-900/80 shadow-sm">
            <p class="font-bold flex items-center space-x-1 mb-1.5 text-amber-950">
                <span>💡 Akun Demo (Password: <code class="bg-white/80 px-1.5 py-0.5 rounded font-mono text-amber-900">password123</code>)</span>
            </p>
            <ul class="space-y-0.5 text-[11px] font-medium text-amber-900/90 pl-1">
                <li>• <strong class="font-semibold text-amber-950">Admin:</strong> admin@gmail.com</li>
                <li>• <strong class="font-semibold text-amber-950">Penjual:</strong> penjual@gmail.com</li>
                <li>• <strong class="font-semibold text-amber-950">Siswa:</strong> pembeli@gmail.com</li>
            </ul>
        </div>

    </div>

</body>
</html>