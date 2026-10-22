<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasbor Penjual - E-commerce')</title>
    
    <!-- CDN Tailwind CSS & FontAwesome Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <div class="min-h-screen flex">
        
        <!-- Panggil Component Sidebar -->
        @include('layouts.sidebarp')

        <!-- Main Layout Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Panggil Component Header -->
            @include('layouts.headerp')

            <!-- Main Content Area / Tempat Konten Halaman Masuk -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 space-y-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Script Responsive Sidebar Toggle Mobile -->
    <script>
        const sidebarp = document.getElementById('sidebarp');
        const openBtn = document.getElementById('open-sidebar-btn');
        const closeBtn = document.getElementById('close-sidebar-btn');

        if(openBtn && sidebarp) {
            openBtn.addEventListener('click', () => {
                sidebar.classList.remove('-translate-x-full');
            });
        }

        if(closeBtn && sidebarp) {
            closeBtn.addEventListener('click', () => {
                sidebarp.classList.add('-translate-x-full');
            });
        }
    </script>
</body>
</html>