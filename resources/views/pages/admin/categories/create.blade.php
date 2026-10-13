@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Kategori Baru</h1>
            <p class="text-sm text-gray-600">Formulir penambahan kategori menu kantin.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">← Kembali</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Makanan Berat, Minuman, Snack" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 @error('name') border-rose-500 @enderror">
                @error('name')
                    <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                <textarea id="description" name="description" rows="3" placeholder="Keterangan singkat mengenai kategori..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 @error('description') border-rose-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">Batal</a>
                <button type="submit" class="px-4 py-2 bg-amber-700 hover:bg-amber-800 text-white text-sm font-medium rounded-lg shadow transition">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection