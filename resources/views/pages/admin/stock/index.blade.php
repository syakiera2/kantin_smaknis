@extends('layouts.admin')

@section('content')
<div class="py-6">

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 text-sm rounded-lg">{{ $errors->first() }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-sm text-gray-600">Total Menu</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-sm text-gray-600">Stok Menipis</p>
            <p class="text-2xl font-bold text-amber-600">{{ $stats['low'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-sm text-gray-600">Stok Habis</p>
            <p class="text-2xl font-bold text-rose-600">{{ $stats['empty'] }}</p>
        </div>
    </div>

    <form method="GET" class="flex flex-wrap gap-2 mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu..."
            class="px-4 py-2 border border-amber-700/40 rounded-lg text-sm">
        <select name="status" class="px-4 py-2 border border-amber-700/40 rounded-lg text-sm">
            <option value="">Semua status</option>
            <option value="low" @selected(request('status') === 'low')>Stok menipis</option>
            <option value="empty" @selected(request('status') === 'empty')>Stok habis</option>
        </select>
        <button class="px-4 py-2 bg-amber-800 hover:bg-amber-900 text-white text-sm rounded-lg">Filter</button>
        <a href="{{ route('admin.stock.daily') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm rounded-lg">Stok Harian</a>
        <a href="{{ route('admin.stock.history') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm rounded-lg">Riwayat</a>
    </form>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-amber-200/70 text-left">
                <tr>
                    <th class="px-4 py-3">Menu</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                    <tr class="border-t border-gray-100">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $menu->nama }}</td>
                        <td class="px-4 py-3">{{ $menu->category?->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $menu->harga_rupiah }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $menu->stok }}</td>
                        <td class="px-4 py-3">
                            @if (! $menu->is_tersedia)
                                <span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-600">Nonaktif</span>
                            @elseif ($menu->stok === 0)
                                <span class="px-2 py-1 rounded-full text-xs bg-rose-100 text-rose-700">Habis</span>
                            @elseif ($menu->stok <= 5)
                                <span class="px-2 py-1 rounded-full text-xs bg-amber-100 text-amber-700">Menipis</span>
                            @else
                                <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Tersedia</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <button type="button"
                                data-url="{{ route('admin.stock.update', $menu) }}"
                                data-nama="{{ $menu->nama }}"
                                data-stok="{{ $menu->stok }}"
                                onclick="openStockModal(this)"
                                class="px-3 py-1 bg-amber-700 hover:bg-amber-800 text-white text-xs rounded-lg">Ubah Stok</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada menu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $menus->links() }}</div>
</div>

{{-- Satu popup dipakai semua menu --}}
<dialog id="stockModal" class="rounded-xl p-0 w-full max-w-md backdrop:bg-black/40">
    <form id="stockForm" method="POST" class="p-6">
        @csrf
        @method('PUT')
        <h3 class="text-lg font-bold mb-1">Ubah Stok</h3>
        <p id="stockInfo" class="text-sm text-gray-600 mb-4"></p>

        <label class="block text-sm font-medium mb-1">Aksi</label>
        <select name="action" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm mb-3">
            <option value="in">Tambah stok (masuk)</option>
            <option value="out">Kurangi stok (keluar)</option>
            <option value="set">Atur ke jumlah tertentu</option>
        </select>

        <label class="block text-sm font-medium mb-1">Jumlah</label>
        <input type="number" name="quantity" min="0" required
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm mb-3">

        <label class="block text-sm font-medium mb-1">Catatan (opsional)</label>
        <input type="text" name="note" maxlength="255"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm mb-5">

        <div class="flex justify-end gap-2">
            <button type="button" onclick="document.getElementById('stockModal').close()"
                class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg">Batal</button>
            <button type="submit"
                class="px-4 py-2 bg-amber-700 hover:bg-amber-800 text-white text-sm rounded-lg">Simpan</button>
        </div>
    </form>
</dialog>

<script>
    function openStockModal(btn) {
        document.getElementById('stockForm').action = btn.dataset.url;
        document.getElementById('stockInfo').textContent =
            btn.dataset.nama + ' (stok saat ini: ' + btn.dataset.stok + ')';
        document.getElementById('stockModal').showModal();
    }
</script>
@endsection