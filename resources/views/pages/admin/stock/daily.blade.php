@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-[#7F5539]">Stok Harian</h1>
    <a href="{{ route('admin.stock.index') }}"
       class="px-4 py-2 rounded-lg bg-white text-[#7F5539] text-sm border border-[#B08968] hover:bg-[#f7efe8]">&larr; Kembali</a>
</div>

@if ($errors->any())
    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 text-sm">
        @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
    </div>
@endif

<form method="POST" action="{{ route('admin.stock.daily.store') }}">
    @csrf
    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[#DDB892] text-[#432818] text-left">
                <tr>
                    <th class="px-4 py-3">Menu</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3 text-center">Stok Sekarang</th>
                    <th class="px-4 py-3 w-40">Stok Awal Hari Ini</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
@foreach ($menus as $menu)
    <tr>
        <td>{{ $menu->nama }}</td>
        <td>{{ $menu->category?->name ?? '-' }}</td>
        <td>
            <input type="number" name="stocks[{{ $menu->id }}]" min="0"
                value="{{ old('stocks.' . $menu->id, $menu->stok) }}"
                class="w-24 px-3 py-1 border border-gray-300 rounded-lg text-sm">
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-end">
        <button class="px-5 py-2 rounded-lg bg-[#7F5539] text-white text-sm hover:bg-[#6a4630]">
            Simpan Stok Harian
        </button>
    </div>
</form>
@endsection