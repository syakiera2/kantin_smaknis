<header class="sticky top-0 z-20 bg-white/90 backdrop-blur-md border-b border-slate-200/80 px-4 md:px-8 py-3.5 flex items-center justify-between gap-4">
    <div class="flex items-center gap-3">
        <!-- Button Sidebar Mobile -->
        <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none">
            <i class="fa-solid fa-bars-staggered text-xl"></i>
        </button>
        
        <div>
            <h2 class="text-lg md:text-xl font-bold text-slate-800 leading-tight">Halo, Budi Santoso 👋</h2>
            <p class="text-xs text-slate-500 hidden sm:block">Siap pesan makan siang untuk istirahat nanti?</p>
        </div>
    </div>

    <!-- Search & Quick Action Header -->
    <div class="flex items-center gap-3 md:gap-4">
        <!-- Info Saldo Quick View -->
        <div class="hidden sm:flex items-center gap-3 bg-slate-50 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-200 p-1.5 pr-4 rounded-full transition cursor-pointer" onclick="openTopUpModal()">
            <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <p class="text-[10px] uppercase tracking-wider font-semibold text-slate-400">Saldo e-Kantin</p>
                <p class="text-xs font-bold text-slate-800">Rp 45.000</p>
            </div>
            <i class="fa-solid fa-circle-plus text-emerald-600 text-sm ml-1"></i>
        </div>

        <!-- Cart Button Header -->
        <button onclick="toggleCartModal()" class="relative p-2.5 rounded-xl bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-700 transition">
            <i class="fa-solid fa-basket-shopping text-lg"></i>
            <span class="absolute -top-1 -right-1 w-5 h-5 bg-amber-500 text-white rounded-full text-[10px] font-bold flex items-center justify-center border-2 border-white">3</span>
        </button>

        <!-- Profile Avatar -->
        <div class="flex items-center gap-3 pl-2 border-l border-slate-200">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Siswa" class="w-9 h-9 rounded-full object-cover border-2 border-emerald-500 shadow-sm">
            <div class="hidden xl:block">
                <p class="text-xs font-bold text-slate-800 leading-none">Budi Santoso</p>
                <p class="text-[10px] text-slate-500">NISN: 005482910</p>
            </div>
        </div>
    </div>
</header>