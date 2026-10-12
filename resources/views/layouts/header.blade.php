<!-- resources/views/layouts/header.blade.php -->
<header class="h-20 bg-transparent px-8 flex items-center justify-between">
    <div>
        <h2 class="text-lg font-bold text-gray-800">Selamat Pagi, Ibu ibu</h2>
        <p class="text-xs text-gray-500">Selamat Datang di Sistem Kantin SMAKNIS</p>
    </div>

    <div class="flex items-center space-x-4">
        <!-- Search Bar -->
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input type="text" placeholder="Search..." class="bg-white border border-gray-200 text-xs rounded-full pl-10 pr-4 py-2.5 w-64 focus:outline-none focus:ring-2 focus:ring-orange-400 shadow-sm">
        </div>

        <!-- Notification Bell -->
        <button class="bg-white p-2.5 rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50 shadow-sm relative">
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-orange-500 rounded-full"></span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        </button>

        <!-- User Profile Avatar -->
        <div class="flex items-center space-x-3 bg-white px-3 py-1.5 rounded-full border border-gray-200 shadow-sm">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=faces" alt="Admin Avatar" class="w-8 h-8 rounded-full object-cover">
            <span class="text-xs font-semibold text-gray-700 pr-2">Ibu Budi</span>
        </div>
    </div>
</header>