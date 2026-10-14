@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-[#7F5539]">Riwayat Stok</h1>
    <a href="{{ route('admin.stock.index') }}"
       class="px-4 py-2 rounded-lg bg-white text-[#7F5539] text-sm border border-[#B08968] hover:bg-[#f7efe8]">&larr; Kembali</a>
</div>

<form method="GET" class="flex flex-wrap gap-2 mb-4">
    <select name="menu_id" class="px-3 py-2 rounded-lg border border-[#B08968] bg-white text-sm">
        <option value="">Semua menu</option>
        @foreach ($menus as $m)
            <option value="{{ $m->id }}" @selected(request('menu_id') == $m->id)>{{ $m->name }}</option>
        @endforeach
    </select>
    <select name="type" class="px-3 py-2 rounded-lg border border-[#B08968] bg-white text-sm">
        <option value="">Semua jenis</option>
        @foreach (\App\Models\StockMovement::TYPES as $key => $label)
            <option value="{{ $key }}" @selected(request('type') === $key)>{{ $label }}</option>
        @endforeach
    </select>
    <input type="date" name="date" value="{{ request('date') }}"
           class="px-3 py-2 rounded-lg border border-[#B08968] bg-white text-sm">
    <button class="px-4 py-2 rounded-lg bg-[#9C6644] text-white text-sm hover:bg-[#7F5539]">Filter</button>
</form>

<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-[#DDB892] text-[#432818] text-left">
            <tr>
                <th class="px-4 py-3">Waktu</th>
                <th class="px-4 py-3">Menu</th>
                <th class="px-4 py-3">Jenis</th>
                <th class="px-4 py-3 text-center">Jumlah</th>
                <th class="px-4 py-3 text-center">Sebelum &rarr; Sesudah</th>
                <th class="px-4 py-3">Oleh</th>
                <th class="px-4 py-3">Catatan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($movements as $mv)
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $mv->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3 font-medium">{{ $mv->menu->name }}</td>
                    <td class="px-4 py-3">{{ $mv->type_label }}</td>
                    <td class="px-4 py-3 text-center font-semibold {{ $mv->quantity >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $mv->quantity > 0 ? '+' : '' }}{{ $mv->quantity }}
                    </td>
                    <td class="px-4 py-3 text-center">{{ $mv->stock_before }} &rarr; {{ $mv->stock_after }}</td>
                    <td class="px-4 py-3">{{ $mv->user->name ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $mv->note ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada riwayat.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $movements->links() }}</div>
@endsection