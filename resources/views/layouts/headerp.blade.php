<!-- Header Navbar -->
<header class="h-16 bg-white border-b border-slate-200 sticky top-0 z-20 flex items-center justify-between px-4 lg:px-8">
    <div class="flex items-center gap-4">
        <!-- Mobile Toggle Button -->
        <button id="open-sidebar-btn" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>

        <!-- Search Bar -->
        <div class="relative hidden sm:block w-72">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" placeholder="Cari pesanan, produk, atau resi..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all placeholder:text-slate-400">
        </div>
    </div>

    <!-- Right Header Actions -->
    <div class="flex items-center gap-3">
        <!-- Status Toko Toggle -->
        <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-100 text-xs font-semibold text-emerald-700">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            Toko Buka
        </div>

        <!-- Notification Button -->
        <button class="relative p-2.5 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors">
            <i class="fa-regular fa-bell text-lg"></i>
            <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
        </button>

        <!-- Message Button -->
        <button class="p-2.5 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors relative">
            <i class="fa-regular fa-comment-dots text-lg"></i>
            <span class="absolute top-1.5 right-1.5 bg-emerald-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">3</span>
        </button>

        <div class="h-6 w-px bg-slate-200 mx-1"></div>

        <!-- Quick Profile Dropdown trigger -->
        <div class="flex items-center gap-2 cursor-pointer p-1 rounded-xl hover:bg-slate-50 transition-colors">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" class="w-8 h-8 rounded-lg object-cover" alt="User">
            <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
        </div>
    </div>
</header>