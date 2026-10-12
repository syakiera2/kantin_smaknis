<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Top Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 font-medium">Penjualan Hari Ini</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">RP 1.250.000</h3>
            </div>
            <div class="bg-orange-100 p-3 rounded-2xl text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 font-medium">Pesanan Aktif</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">45</h3>
            </div>
            <div class="bg-orange-100 p-3 rounded-2xl text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-400 font-medium">Menu Habis</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">3</h3>
            </div>
            <div class="bg-orange-100 p-3 rounded-2xl text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Middle Section: Real-time Stock & Monthly Sales Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Manajemen Stok & Menu Real-time -->
        <div class="lg:col-span-2 bg-gradient-to-r from-orange-200 via-orange-100 to-amber-100 p-6 rounded-3xl shadow-sm relative overflow-hidden flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Manajemen Stok & Menu Real-time</h3>
                <ul class="mt-3 space-y-2 text-xs text-gray-700">
                    <li class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-600 rounded-full"></span>
                        <span><strong>Pembaruan Stok Otomatis:</strong> Pembaruan payment stok otomatis</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-orange-600 rounded-full"></span>
                        <span><strong>Manajemen Menu Mitra:</strong> Manajemen payment menu mitra</span>
                    </li>
                </ul>
            </div>

            <!-- Floating Widget Card inside banner -->
            <div class="mt-6 bg-white/80 backdrop-blur-md p-4 rounded-2xl shadow-sm border border-white flex items-center justify-between max-w-sm">
                <div class="flex items-center space-x-3">
                    <div class="bg-orange-100 p-2 rounded-xl">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-800">Nasi Goreng</h4>
                        <p class="text-[10px] text-gray-500">Rp 15.000</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-[10px] text-gray-400">Stok: 25</span>
                    <div class="w-20 bg-gray-200 h-1.5 rounded-full mt-1 overflow-hidden">
                        <div class="bg-orange-500 h-full w-3/4"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Penjualan Bulanan -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center">
                    <h3 class="text-sm font-bold text-gray-800">Grafik Penjualan Bulanan</h3>
                    <div class="flex space-x-1 text-[10px] text-gray-500 bg-gray-100 p-1 rounded-lg">
                        <span class="px-2 py-0.5">Day</span>
                        <span class="px-2 py-0.5">Week</span>
                        <span class="bg-white px-2 py-0.5 rounded shadow-sm font-bold text-orange-600">Month</span>
                        <span class="px-2 py-0.5">Year</span>
                    </div>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">Rekapitulasi Keuangan</p>
                <h4 class="text-xl font-extrabold text-gray-800 mt-0.5">Rp 3.842.500</h4>
            </div>

            <!-- Dummy Chart Simulation Line -->
            <div class="mt-4">
                <div class="h-24 flex items-end space-x-4 border-b border-gray-100 pb-2">
                    <div class="w-full bg-orange-100 h-10 rounded-t-lg"></div>
                    <div class="w-full bg-orange-200 h-16 rounded-t-lg"></div>
                    <div class="w-full bg-orange-500 h-20 rounded-t-lg relative">
                        <span class="absolute -top-6 left-1/2 -translate-x-1/2 bg-orange-600 text-white text-[9px] px-1.5 py-0.5 rounded shadow">Mar</span>
                    </div>
                    <div class="w-full bg-orange-300 h-14 rounded-t-lg"></div>
                    <div class="w-full bg-orange-200 h-12 rounded-t-lg"></div>
                </div>
                <div class="flex justify-between text-[10px] text-gray-400 mt-2">
                    <span>Jan</span><span>Feb</span><span class="font-bold text-orange-600">Mar</span><span>Apr</span><span>May</span><span>Jun</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Transactions & Status Mitra & Target -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Bukti Transaksi Digital Terbaru -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-800 mb-4">Bukti Transaksi Digital Terbaru</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-2.5 rounded-2xl bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center text-xs">🍜</div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Soto Ayam</h4>
                            <p class="text-[10px] text-gray-400">Tunai / QRIS</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-gray-700">- Rp 20k</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-2xl bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center text-xs">🥤</div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Es Teh</h4>
                            <p class="text-[10px] text-gray-400">Tunai</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-gray-700">- Rp 5k</span>
                </div>
            </div>
        </div>

        <!-- Status Stok Mitra -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-800 mb-4">Status Stok Mitra</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=80&h=80&fit=crop" class="w-9 h-9 rounded-full object-cover">
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Mitra Pak Jono</h4>
                            <p class="text-[10px] text-gray-500">Nasi Goreng (20)</p>
                        </div>
                    </div>
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=80&h=80&fit=crop" class="w-9 h-9 rounded-full object-cover">
                        <div>
                            <h4 class="text-xs font-bold text-gray-800">Mitra Ibu Sri</h4>
                            <p class="text-[10px] text-gray-500">Bakso (12)</p>
                        </div>
                    </div>
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                </div>
            </div>
        </div>

        <!-- Target Harian -->
        <div class="bg-[#5C3A21] text-white p-6 rounded-3xl shadow-md flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-bold">Target Harian</h3>
                <p class="text-[10px] text-orange-200">Capaian Penjualan Hari Ini</p>
            </div>
            <div class="flex items-center justify-between my-4">
                <div>
                    <h4 class="text-xs text-orange-200">Total Tercapai</h4>
                    <p class="text-base font-bold">Rp 1.025.000 <span class="text-xs font-normal text-orange-300">/ 1.250.000</span></p>
                </div>
                <!-- Circular Percentage / Progress Indicator -->
                <div class="relative w-12 h-12 flex items-center justify-center bg-orange-600 rounded-full font-bold text-xs shadow-inner">
                    82%
                </div>
            </div>
            <div class="w-full bg-[#402715] h-2 rounded-full overflow-hidden">
                <div class="bg-orange-400 h-full w-[82%]"></div>
            </div>
        </div>
    </div>
</div>
@endsection