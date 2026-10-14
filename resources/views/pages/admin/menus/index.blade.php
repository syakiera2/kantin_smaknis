@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- Judul + tombol tambah --}}
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-[#7F5539]">Kelola Menu</h1>
            <p class="text-sm text-gray-600">Atur menu makanan &amp; minuman, harga, dan stok harian.</p>
        </div>
        <a href="{{ route('admin.menus.create') }}"
           class="inline-flex items-center rounded-lg bg-[#7F5539] px-4 py-2 text-sm font-semibold text-white shadow hover:bg-[#6b4630]">
            + Tambah Menu
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-xl bg-white p-4 shadow-sm">
            <p class="text-xs uppercase text-gray-500">Total Menu</p>
            <p class="mt-1 text-2xl font-bold">{{ $stats['total'] }}</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow-sm">
            <p class="text-xs uppercase text-gray-500">Tersedia</p>
            <p class="mt-1 text-2xl font-bold text-green-600">{{ $stats['tersedia'] }}</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow-sm">
            <p class="text-xs uppercase text-gray-500">Stok Habis</p>
            <p class="mt-1 text-2xl font-bold text-red-600">{{ $stats['habis'] }}</p>
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" class="flex flex-wrap gap-3 rounded-xl bg-white p-4 shadow-sm">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama menu..."
               class="min-w-[200px] flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#7F5539] focus:outline-none focus:ring-1 focus:ring-[#7F5539]">
        <select name="kategori"
                class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#7F5539] focus:outline-none focus:ring-1 focus:ring-[#7F5539]">
            <option value="">Semua kategori</option>
            @foreach ($kategoriList as $key => $label)
                <option value="{{ $key }}" @selected(request('kategori') === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <button class="rounded-lg bg-[#B08968] px-4 py-2 text-sm font-semibold text-white hover:bg-[#9c7857]">Filter</button>
        @if (request()->hasAny(['q', 'kategori']))
            <a href="{{ route('admin.menus.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50">Reset</a>
        @endif
    </form>

    {{-- Tabel --}}
    <div class="overflow-x-auto rounded-xl bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-[#DDB892]/40 text-left text-xs uppercase text-gray-700">
                <tr>
                    <th class="px-4 py-3">Menu</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($menus as $menu)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if ($menu->gambar_url)
                                    <img src="{{ $menu->gambar_url }}" alt="{{ $menu->nama }}" class="h-12 w-12 rounded-lg object-cover">
                                @else
                                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-[#EDE0D4] text-xl">🍽️</div>
                                @endif
                                <div>
                                    <p class="font-semibold">{{ $menu->nama }}</p>
                                    @if ($menu->deskripsi)
                                        <p class="max-w-xs truncate text-xs text-gray-500">{{ $menu->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">{{ $kategoriList[$menu->kategori] ?? $menu->kategori }}</td>
                        <td class="px-4 py-3 font-medium">{{ $menu->harga_rupiah }}</td>
                        <td class="px-4 py-3">{{ $menu->stok }}</td>
                        <td class="px-4 py-3">
                            @php
                                $badge = match ($menu->status) {
                                    'Tersedia' => 'bg-green-100 text-green-700',
                                    'Habis'    => 'bg-red-100 text-red-700',
                                    default    => 'bg-gray-200 text-gray-600',
                                };
                            @endphp
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $badge }}">{{ $menu->status }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <form method="POST" action="{{ route('admin.menus.toggle', $menu) }}">
                                    @csrf @method('PATCH')
                                    <button class="rounded-md border border-gray-300 px-2.5 py-1 text-xs hover:bg-gray-100">
                                        {{ $menu->is_tersedia ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                                <a href="{{ route('admin.menus.edit', $menu) }}"
                                   class="rounded-md bg-[#B08968] px-2.5 py-1 text-xs font-semibold text-white hover:bg-[#9c7857]">Edit</a>
                                <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}"
                                      onsubmit="return confirm('Hapus menu {{ $menu->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button class="rounded-md bg-red-600 px-2.5 py-1 text-xs font-semibold text-white hover:bg-red-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-gray-500">Belum ada menu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>{{ $menus->links() }}</div>
</div>
@endsection