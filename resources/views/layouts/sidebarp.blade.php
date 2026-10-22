<!-- Sidebar -->
<aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-slate-300 transition-transform duration-300 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between shadow-xl">
    <div>
        <!-- Logo / Toko -->
        <div class="h-16 flex items-center px-6 bg-slate-950/50 border-b border-slate-800 justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-[#ffffff] font-bold text-white shadow-lg shadow-emerald-500/20 justify-center">
                    <i class="fa-solid fa-store text-lg"></i>
                </div>
                <div>
                    <h1 class="font-bold text-white text-base leading-tight">Toko Berkah</h1>
                    <span class="text-xs text-emerald-400 font-medium flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Official Store
                    </span>
                </div>
            </div>
            <!-- Mobile Close Button -->
            <button id="close-sidebar-btn" class="lg:hidden text-slate-400 hover:text-white">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-1.5 text-sm font-medium">
            <div class="px-3 pb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Utama</div>
            
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/30 transition-all">
                <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                <span>Dasbor</span>
            </a>

            <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-slate-200 transition-all group">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-shopping-bag w-5 text-center text-base group-hover:text-emerald-400 transition-colors"></i>
                    <span>Pesanan</span>
                </div>
                <span class="bg-emerald-500/10 text-emerald-400 text-xs px-2 py-0.5 rounded-full border border-emerald-500/20">12 Baru</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-slate-200 transition-all group">
                <i class="fa-solid fa-box-open w-5 text-center text-base group-hover:text-emerald-400 transition-colors"></i>
                <span>Produk Toko</span>
            </a>

            <div class="pt-4 px-3 pb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Analistik & Keuangan</div>

            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-slate-200 transition-all group">
                <i class="fa-solid fa-wallet w-5 text-center text-base group-hover:text-emerald-400 transition-colors"></i>
                <span>Saldo & Saluran Halaman</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-slate-200 transition-all group">
                <i class="fa-solid fa-star w-5 text-center text-base group-hover:text-emerald-400 transition-colors"></i>
                <span>Ulasan Pembeli</span>
            </a>

            <div class="pt-4 px-3 pb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pengaturan</div>

            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-slate-200 transition-all group">
                <i class="fa-solid fa-sliders w-5 text-center text-base group-hover:text-emerald-400 transition-colors"></i>
                <span>Pengaturan Toko</span>
            </a>
        </nav>
    </div>

    <!-- User Profile Bottom Sidebar -->
    <div class="p-4 border-t border-slate-800">
        <div class="flex items-center justify-between p-2 rounded-xl bg-slate-800/50">
            <div class="flex items-center gap-3">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" class="w-9 h-9 rounded-lg object-cover ring-2 ring-emerald-500/30" alt="Avatar">
                <div class="overflow-hidden">
                    <p class="text-sm font-semibold text-white truncate">Budi Santoso</p>
                    <p class="text-xs text-slate-400 truncate">Pemilik Toko</p>
                </div>
            </div>
            <button class="text-slate-400 hover:text-rose-400 transition-colors p-1.5 rounded-lg hover:bg-slate-700/50" title="Keluar">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </div>
    </div>
</aside>