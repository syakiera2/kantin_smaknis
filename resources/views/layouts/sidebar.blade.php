<!-- resources/views/layouts/sidebar.blade.php -->
@php
    use Illuminate\Support\Facades\Route;

    /**
     * Helper link aman: jika nama route belum dibuat, link jadi "#"
     * sehingga halaman tidak error saat fitur belum selesai dikerjakan.
     */
    $link = fn (?string $name) => $name && Route::has($name) ? route($name) : '#';

    /**
     * Badge angka opsional (mis. jumlah transaksi menunggu verifikasi).
     * Kirim dari View Composer / controller: ['verifikasi' => 3, 'pencairan' => 1, 'komplain' => 2]
     */
    $badges = $sidebarBadges ?? [];

    /**
     * Daftar menu. Cukup ubah array ini untuk menambah/mengurangi menu.
     * - label   : teks menu
     * - route   : nama route (boleh belum ada)
     * - active  : pola routeIs untuk menandai menu aktif
     * - icon    : path SVG (Heroicons outline)
     * - badge   : kunci badge (opsional)
     */
    $groups = [
        [
            'title' => '1. Manajemen Pengguna',
            'items' => [
                ['label' => 'Akun Siswa & Pegawai', 'route' => 'admin.akun.index', 'active' => 'admin.akun.*',
                 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['label' => 'Hak Akses & Penjual', 'route' => 'admin.vendors.index', 'active' => 'admin.vendors.*',
                 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
            ],
        ],
        [
            'title' => '2. Keuangan & Cashless',
            'items' => [
                ['label' => 'Top Up Saldo', 'route' => 'admin.topups.index', 'active' => 'admin.topups.*',
                 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
                ['label' => 'Pantau Transaksi Real-time', 'route' => 'admin.monitor.index', 'active' => 'admin.monitor.*',
                 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['label' => 'Pencairan Dana Penjual', 'route' => 'admin.withdrawals.index', 'active' => 'admin.withdrawals.*', 'badge' => 'pencairan',
                 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'],
            ],
        ],
        [
            'title' => '3. Menu & Produk',
            'items' => [
                ['label' => 'Kategori Makanan', 'route' => 'admin.categories.index', 'active' => 'admin.categories.*',
                 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                ['label' => 'Katalog Menu Makanan/Minuman', 'route' => 'admin.menus.index', 'active' => 'admin.menus.*',
                 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['label' => 'Pengaturan Harga', 'route' => 'admin.prices.index', 'active' => 'admin.prices.*',
                 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                ['label' => 'Kontrol Stok (Persediaan)', 'route' => 'admin.stock.index', 'active' => 'admin.stock.*',
                 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
            ],
        ],
        [
            'title' => '4. Manajemen Pemesanan',
            'items' => [
                ['label' => 'Status Pesanan & Pre-Order', 'route' => 'admin.orders.index', 'active' => 'admin.orders.*',
                 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                ['label' => 'Verifikasi Transaksi', 'route' => 'admin.verifications.index', 'active' => 'admin.verifications.*', 'badge' => 'verifikasi',
                 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['label' => 'Komplain Pembeli', 'route' => 'admin.complaints.index', 'active' => 'admin.complaints.*', 'badge' => 'komplain',
                 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
            ],
        ],
        [
            'title' => '5. Pelaporan & Analisis',
            'items' => [
                ['label' => 'Laporan Harian / Bulanan', 'route' => 'admin.reports.sales', 'active' => 'admin.reports.sales*',
                 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['label' => 'Laporan per Vendor', 'route' => 'admin.reports.vendor', 'active' => 'admin.reports.vendor*',
                 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['label' => 'Analisis Menu Terlaris', 'route' => 'admin.reports.top-menu', 'active' => 'admin.reports.top-menu*',
                 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
            ],
        ],
        [
            'title' => '6. Sistem & Keamanan',
            'items' => [
                ['label' => 'Pengumuman & Notifikasi', 'route' => 'admin.announcements.index', 'active' => 'admin.announcements.*',
                 'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
                ['label' => 'Log Audit', 'route' => 'admin.audit.index', 'active' => 'admin.audit.*',
                 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ],
        ],
    ];
@endphp

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
            <a href="{{ $link('admin.dashboard') }}"
               class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-[#E3D5CA] text-gray-900 shadow-sm' : 'text-gray-600 hover:bg-[#EFEBE9]' }}">
                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span>Dasbor</span>
            </a>

            <!-- Grup menu (dibuat dari array $groups di atas) -->
            @foreach ($groups as $group)
                <div class="pt-2">
                    <p class="px-4 text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">{{ $group['title'] }}</p>

                    @foreach ($group['items'] as $item)
                        @php
                            $isActive = request()->routeIs($item['active']);
                            $count    = isset($item['badge']) ? ($badges[$item['badge']] ?? 0) : 0;
                        @endphp
                        <a href="{{ $link($item['route']) }}"
                           @if ($isActive) aria-current="page" @endif
                           class="flex items-center justify-between px-4 py-2 rounded-xl text-xs font-medium {{ $isActive ? 'bg-[#E3D5CA] text-gray-900 shadow-sm' : 'text-gray-600 hover:bg-[#EFEBE9]' }}">
                            <span class="flex items-center space-x-3">
                                <svg class="w-4 h-4 text-orange-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"></path></svg>
                                <span>{{ $item['label'] }}</span>
                            </span>

                            @if ($count > 0)
                                <span class="ml-2 min-w-[1.25rem] text-center rounded-full bg-red-500 px-1.5 py-0.5 text-[10px] font-bold text-white">
                                    {{ $count > 99 ? '99+' : $count }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endforeach

            <!-- Pengaturan Kantin -->
            <div class="pt-4 border-t border-[#E3D5CA] space-y-1">
                <a href="{{ $link('admin.settings.index') }}"
                   class="flex items-center space-x-3 px-4 py-2.5 rounded-xl font-medium text-sm {{ request()->routeIs('admin.settings.*') ? 'bg-[#E3D5CA] text-gray-900 shadow-sm' : 'text-gray-600 hover:bg-[#EFEBE9]' }}">
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