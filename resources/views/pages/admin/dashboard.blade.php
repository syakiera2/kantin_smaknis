@extends('layouts.admin')

@section('content')
<div class="space-y-6 pb-10">

    <!-- Top Greeting Banner & Quick Actions -->
    <div class="bg-gradient-to-r from-[#5C3A21] to-[#8C5835] rounded-3xl p-6 sm:p-8 text-white shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative overflow-hidden">
        <!-- Background Glow Elements -->
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-orange-500/20 rounded-full blur-2xl pointer-events-none"></div>
        
        <div class="relative z-10">
            <span class="bg-orange-500/30 text-orange-200 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">Panel Kontrol Utama</span>
            <h2 class="text-2xl font-black mt-2 tracking-tight">Halo, Ibu Budi 👋</h2>
            <p class="text-xs text-orange-100/80 mt-1 max-w-lg">Sistem operasional kantin digital SMAKNIS berjalan lancar. Seluruh data transaksi, tenant, dan stok terpantau real-time hari ini.</p>
        </div>

        <div class="relative z-10 flex items-center space-x-3 w-full md:w-auto">
            <a href="#" class="flex-1 md:flex-none bg-white text-gray-900 font-bold text-xs px-4 py-3 rounded-2xl shadow-sm hover:bg-orange-50 transition text-center">
                + Top Up Saldo Massal
            </a>
            <a href="#" class="flex-1 md:flex-none bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs px-4 py-3 rounded-2xl shadow-md transition text-center">
                Unduh Laporan Hari Ini
            </a>
        </div>
    </div>

    <!-- 4 Modern Metric Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1 -->
        <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
                <h3 class="text-xl font-black text-gray-800 mt-1">Rp 3.842.500</h3>
                <span class="text-[10px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-md mt-2 inline-block">↑ 12% dari kemarin</span>
            </div>
            <div class="bg-orange-100 text-orange-600 p-3.5 rounded-2xl shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Transaksi Masuk</p>
                <h3 class="text-xl font-black text-gray-800 mt-1">142 Pesanan</h3>
                <span class="text-[10px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-md mt-2 inline-block">Verifikasi QRIS & Saldo</span>
            </div>
            <div class="bg-amber-100 text-amber-700 p-3.5 rounded-2xl shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Tenant / Penjual</p>
                <h3 class="text-xl font-black text-gray-800 mt-1">8 Stand Aktif</h3>
                <span class="text-[10px] text-blue-600 font-bold bg-blue-50 px-2 py-0.5 rounded-md mt-2 inline-block">Semua Buka</span>
            </div>
            <div class="bg-orange-100 text-orange-600 p-3.5 rounded-2xl shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Stok Menu Menipis</p>
                <h3 class="text-xl font-black text-red-600 mt-1">3 Menu Habis</h3>
                <span class="text-[10px] text-red-600 font-bold bg-red-50 px-2 py-0.5 rounded-md mt-2 inline-block">Perlu Restock</span>
            </div>
            <div class="bg-red-100 text-red-600 p-3.5 rounded-2xl shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Main Content Split Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left 2 Columns: Chart & Live Transactions -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Analytics Chart Card -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Grafik Penjualan & Perputaran Kas</h3>
                        <p class="text-xs text-gray-400">Analisis tren omzet mingguan kantin sekolah.</p>
                    </div>
                    <div class="bg-gray-100 p-1 rounded-xl flex space-x-1 text-xs font-semibold text-gray-600">
                        <button class="px-3 py-1 rounded-lg bg-white shadow-sm text-orange-600">Mingguan</button>
                        <button class="px-3 py-1 rounded-lg hover:text-gray-900">Bulanan</button>
                    </div>
                </div>

                <!-- Simulative Clean Chart Visual -->
                <div class="h-48 w-full flex items-end justify-between gap-2 sm:gap-4 pt-6 px-2 border-b border-gray-100 pb-3">
                    <div class="w-full bg-orange-100 hover:bg-orange-500 rounded-t-xl h-[40%] transition-all relative group cursor-pointer"></div>
                    <div class="w-full bg-orange-200 hover:bg-orange-500 rounded-t-xl h-[65%] transition-all relative group cursor-pointer"></div>
                    <div class="w-full bg-orange-300 hover:bg-orange-500 rounded-t-xl h-[50%] transition-all relative group cursor-pointer"></div>
                    <div class="w-full bg-orange-400 hover:bg-orange-500 rounded-t-xl h-[80%] transition-all relative group cursor-pointer"></div>
                    <div class="w-full bg-orange-500 rounded-t-xl h-[95%] transition-all relative group cursor-pointer shadow-md"></div>
                    <div class="w-full bg-orange-300 hover:bg-orange-500 rounded-t-xl h-[70%] transition-all relative group cursor-pointer"></div>
                    <div class="w-full bg-orange-200 hover:bg-orange-500 rounded-t-xl h-[85%] transition-all relative group cursor-pointer"></div>
                </div>
                <div class="flex justify-between text-[11px] font-bold text-gray-400 pt-3 px-2">
                    <span>Senin</span>
                    <span>Selasa</span>
                    <span>Rabu</span>
                    <span>Kamis</span>
                    <span class="text-orange-600 font-extrabold">Jumat (Hari Ini)</span>
                    <span>Sabtu</span>
                    <span>Minggu</span>
                </div>
            </div>

            <!-- Recent Digital Transactions Table -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base font-bold text-gray-900">Verifikasi & Transaksi Cashless Terbaru</h3>
                    <a href="#" class="text-xs text-orange-600 font-bold hover:underline">Lihat Semua →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-400 uppercase tracking-wider font-bold">
                            <tr>
                                <th class="p-3 rounded-l-xl">Konsumen / Siswa</th>
                                <th class="p-3">Menu Dipesan</th>
                                <th class="p-3">Metode</th>
                                <th class="p-3">Nominal</th>
                                <th class="p-3 rounded-r-xl">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr>
                                <td class="p-3 font-bold text-gray-800">Andi (Kelas X RPL)</td>
                                <td class="p-3 text-gray-600">Nasi Goreng Spesial</td>
                                <td class="p-3 text-gray-500">Saldo App</td>
                                <td class="p-3 font-bold text-gray-800">Rp 15.000</td>
                                <td class="p-3"><span class="bg-emerald-50 text-emerald-700 font-bold px-2.5 py-1 rounded-full text-[10px]">Berhasil</span></td>
                            </tr>
                            <tr>
                                <td class="p-3 font-bold text-gray-800">Siti (Kelas XI TKJ)</td>
                                <td class="p-3 text-gray-600">Soto Ayam + Es Teh</td>
                                <td class="p-3 text-gray-500">QRIS</td>
                                <td class="p-3 font-bold text-gray-800">Rp 25.000</td>
                                <td class="p-3"><span class="bg-emerald-50 text-emerald-700 font-bold px-2.5 py-1 rounded-full text-[10px]">Berhasil</span></td>
                            </tr>
                            <tr>
                                <td class="p-3 font-bold text-gray-800">Budi (Guru)</td>
                                <td class="p-3 text-gray-600">Mie Ayam Bakso</td>
                                <td class="p-3 text-gray-500">Saldo App</td>
                                <td class="p-3 font-bold text-gray-800">Rp 18.000</td>
                                <td class="p-3"><span class="bg-amber-50 text-amber-700 font-bold px-2.5 py-1 rounded-full text-[10px]">Menunggu Verifikasi</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Right 1 Column: Tenant Status & Inventory Alerts -->
        <div class="space-y-6">
            
            <!-- Tenant / Vendor Status -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="text-base font-bold text-gray-900 mb-4">Status Tenant & Stand Kantin</h3>
                
                <div class="space-y-4">
                    <!-- Tenant 1 -->
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-gray-50 border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-orange-200 flex items-center justify-center font-bold text-orange-800 text-xs">PJ</div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800">Stand Pak Jono</h4>
                                <p class="text-[10px] text-gray-400">Aneka Nasi & Gorengan</p>
                            </div>
                        </div>
                        <span class="flex items-center space-x-1.5 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            <span>Buka</span>
                        </span>
                    </div>

                    <!-- Tenant 2 -->
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-gray-50 border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-amber-200 flex items-center justify-center font-bold text-amber-800 text-xs">IS</div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800">Stand Ibu Sri</h4>
                                <p class="text-[10px] text-gray-400">Bakso & Soto Spesial</p>
                            </div>
                        </div>
                        <span class="flex items-center space-x-1.5 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            <span>Buka</span>
                        </span>
                    </div>

                    <!-- Tenant 3 -->
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-gray-50 border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center font-bold text-orange-700 text-xs">DR</div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800">Stand Minuman Segar</h4>
                                <p class="text-[10px] text-gray-400">Es Teh, Jus & Aneka Es</p>
                            </div>
                        </div>
                        <span class="flex items-center space-x-1.5 text-[10px] font-bold text-red-600 bg-red-50 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                            <span>Tutup</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Inventory / Stock Control Widget -->
            <div class="bg-[#5C3A21] text-white p-6 rounded-3xl shadow-md space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-sm font-bold">Kontrol Stok & Menu</h3>
                    <span class="bg-orange-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full">Automasi Aktif</span>
                </div>
                <p class="text-xs text-orange-100/80 leading-relaxed">Sistem secara otomatis mengunci menu jika porsi harian pada masing-masing tenant habis.</p>
                
                <div class="bg-[#402715] p-4 rounded-2xl border border-white/10 space-y-3">
                    <div class="flex justify-between items-center text-xs">
                        <span>Nasi Goreng Pak Jono</span>
                        <span class="text-orange-400 font-bold">Sisa 5 Porsi</span>
                    </div>
                    <div class="w-full bg-black/30 h-2 rounded-full overflow-hidden">
                        <div class="bg-orange-500 h-full w-[20%]"></div>
                    </div>
                </div>

                <a href="#" class="block w-full bg-white text-gray-900 font-bold text-xs py-3 rounded-xl text-center shadow hover:bg-orange-50 transition">
                    Kelola Seluruh Katalog Menu →
                </a>
            </div>

        </div>

    </div>

</div>
@endsection