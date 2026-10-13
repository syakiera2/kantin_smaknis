<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="w-72 bg-[#F5EBE6] border-r border-[#E3D5CA] flex flex-col justify-between h-screen sticky top-0 font-sans shadow-sm overflow-y-auto">
    <div>
        <!-- Logo / Brand -->
        <div class="p-6 flex items-center space-x-3">
            <div class="bg-orange-600 p-2 rounded-xl text-white shadow-md">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <div>
                <h1 class="font-bold text-gray-800 text-lg leading-tight">SMAKNIS</h1>
                <p class="text-xs text-gray-500 font-medium">Admin Kantin</p>
            </div>
        </div>

        <!-- Navigation Menu Berdasarkan Alur Admin -->
        <nav class="px-4 space-y-2 pb-6">
            <!-- Dasbor -->
            <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-[#E3D5CA] text-gray-900 shadow-sm' : 'text-gray-600 hover:bg-[#EFEBE9]' }}">
                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V16zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-16z"></path></svg>
                <span>Dasbor</span>
            </a>

            <!-- 1. Manajemen Pengguna (User Management) -->
            <div class="pt-2">
                <p class="px-4 text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">1. Manajemen Pengguna</p>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Akun Siswa & Pegawai</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span>Hak Akses Tenant/Penjual</span>
                </a>
            </div>

            <!-- 2. Manajemen Keuangan & Pembayaran Digital -->
            <div class="pt-2">
                <p class="px-4 text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">2. Keuangan & Cashless</p>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <span>Top Up Saldo</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span>Pantau Transaksi Real-time</span>
                </a>
            </div>

            <!-- 3. Manajemen Menu & Produk -->
            <div class="pt-2">
                <p class="px-4 text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">3. Menu & Produk</p>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <span>kategori </span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    <span>Pengaturan Harga</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span>Kontrol Stok (Persediaan)</span>
                </a>
            </div>

            <!-- 4. Manajemen Pemesanan -->
            <div class="pt-2">
                <p class="px-4 text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">4. Manajemen Pemesanan</p>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    <span>Status Pesanan & Pre-Order</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <span>Verifikasi Transaksi</span>
                </a>
            </div>

            <!-- 5. Pelaporan & Analisis -->
            <div class="pt-2">
                <p class="px-4 text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">5. Pelaporan & Analisis</p>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Laporan Harian / Bulanan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span>Laporan per Vendor</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-xl text-xs font-medium text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <span>Analisis Menu Terlaris</span>
                </a>
            </div>

            <!-- Pengaturan Kantin & Bantuan -->
            <div class="pt-4 border-t border-[#E3D5CA] space-y-1">
                <a href="#" class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm text-gray-600 hover:bg-[#EFEBE9]">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>Pengaturan Kantin</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Tombol Logout -->
    <div class="p-4 border-t border-[#E3D5CA]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>