<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Kantin SMAKNIS</title>

    <!-- Tailwind CSS (Tailwind CDN / Vite Laravel 12) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#EDE0D4] font-sans antialiased text-gray-800">
    <div class="flex h-screen overflow-hidden">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Include Header -->
            @include('layouts.header')

            <!-- Main Dynamic Content -->
            <main class="px-8 pb-8 pt-2">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>