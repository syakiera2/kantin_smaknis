@extends('layouts.admin')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <h1 class="text-2xl font-bold text-[#7F5539]">Kontrol Stok</h1>
    <div class="flex gap-2">
        <a href="{{ route('admin.stock.daily') }}"
           class="px-4 py-2 rounded-lg bg-[#7F5539] text-white text-sm hover:bg-[#6a4630]">Stok Harian</a>
        <a href="{{ route('admin.stock.history') }}"
           class="px-4 py-2 rounded-lg bg-white text-[#7F5539] text-sm border border-[#B08968] hover:bg-[#f7efe8]">Riwayat</a>
    </div>
</div>

@if (session('success'))
    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 text-sm">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 text-sm">
        @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
    </div>
@endif

{{-- Statistik --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl p-4 shadow-sm">
        <p class="text-sm text-gray-500">Total Menu</p>
        <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm">
        <p class="text-sm text-gray-500">Stok Menipis</p>
        <p class="text-2xl font-bold text-amber-600">{{ $stats['low'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-sm">
        <p class="text-sm text-gray-500">Stok Habis</p>
        <p class="text-2xl font-bold text-red-600">{{ $stats['empty'] }}</p>
    </div>
</div>

{{-- Filter --}}
<form method="GET" class="flex flex-wrap gap-2 mb-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu..."
           class="px-3 py-2 rounded-lg border border-[#B08968] bg-white text-sm w-full sm:w-64">
    <select name="status" class="px-3 py-2 rounded-lg border border-[#B08968] bg-white text-sm">
        <option value="">Semua status</option>
        <option value="low"   @selected(request('status') === 'low')>Menipis</option>
        <option value="empty" @selected(request('status') === 'empty')>Habis</option>
    </select>
    <button class="px-4 py-2 rounded-lg bg-[#9C6644] text-white text-sm hover:bg-[#7F5539]">Filter</button>
</form>

{{-- Tabel --}}
<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-[#DDB892] text-[#432818] text-left">
            <tr>
                <th class="px-4 py-3">Menu</th>
                <th class="px-4 py-3">Kategori</th>
                <th class="px-4 py-3">Harga</th>
                <th class="px-4 py-3 text-center">Stok</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($menus as $menu)
                @php
                    $badge = match ($menu->stock_status) {
                        'habis'   => 'bg-red-100 text-red-700',
                        'menipis' => 'bg-amber-100 text-amber-700',
                        default   => 'bg-green-100 text-green-700',
                    };
                @endphp
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $menu->name }}</td>
                    <td class="px-4 py-3 capitalize">{{ $menu->category }}</td>
                    <td class="px-4 py-3">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-center font-semibold">{{ $menu->stock }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium capitalize {{ $badge }}">
                            {{ $menu->stock_status }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button type="button"
                                data-id="{{ $menu->id }}"
                                data-name="{{ $menu->name }}"
                                data-stock="{{ $menu->stock }}"
                                class="btn-stock px-3 py-1.5 rounded-lg bg-[#B08968] text-white text-xs hover:bg-[#9C6644]">
                            Ubah Stok
                        </button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Menu tidak ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $menus->links() }}</div>

{{-- Modal ubah stok --}}
<dialog id="stockModal" class="rounded-xl p-0 w-full max-w-md backdrop:bg-black/40">
    <form id="stockForm" method="POST" class="p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <h2 class="text-lg font-bold text-[#7F5539]">Ubah Stok</h2>
            <p class="text-sm text-gray-500"><span id="modalName"></span> — stok saat ini: <b id="modalStock"></b></p>
        </div>

        <div>
            <label class="block text-sm mb-1">Aksi</label>
            <select name="action" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm">
                <option value="in">Tambah stok</option>
                <option value="out">Kurangi stok (rusak/terbuang)</option>
                <option value="set">Set stok (stok awal / opname)</option>
            </select>
        </div>
        <div>
            <label class="block text-sm mb-1">Jumlah</label>
            <input type="number" name="quantity" min="0" required
                   class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm">
        </div>
        <div>
            <label class="block text-sm mb-1">Catatan (opsional)</label>
            <input type="text" name="note" maxlength="255"
                   class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm">
        </div>

        <div class="flex justify-end gap-2 pt-2">
            <button type="button" id="closeModal"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-sm">Batal</button>
            <button class="px-4 py-2 rounded-lg bg-[#7F5539] text-white text-sm hover:bg-[#6a4630]">Simpan</button>
        </div>
    </form>
</dialog>

<script>
    const modal = document.getElementById('stockModal');
    const form  = document.getElementById('stockForm');
    const urlTemplate = "{{ route('admin.stock.update', ':id') }}";

    document.querySelectorAll('.btn-stock').forEach(btn => {
        btn.addEventListener('click', () => {
            form.action = urlTemplate.replace(':id', btn.dataset.id);
            document.getElementById('modalName').textContent  = btn.dataset.name;
            document.getElementById('modalStock').textContent = btn.dataset.stock;
            form.reset();
            modal.showModal();
        });
    });
    document.getElementById('closeModal').addEventListener('click', () => modal.close());
</script>
@endsection