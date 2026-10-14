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
                        <td class="px-4 py-3 font-medium">{{ $menu->name }}</td>
                        <td class="px-4 py-3 capitalize">{{ $menu->category }}</td>
                        <td class="px-4 py-3 text-center">{{ $menu->stock }}</td>
                        <td class="px-4 py-3">
                            <input type="number" min="0" required
                                   name="stocks[{{ $menu->id }}]"
                                   value="{{ old('stocks.' . $menu->id, $menu->stock) }}"
                                   class="w-full px-3 py-1.5 rounded-lg border border-gray-300">
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