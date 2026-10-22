@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Menu</h1>
            <p class="text-sm text-gray-600">Perbarui data menu kantin.</p>
        </div>
        <a href="{{ route('admin.menus.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">← Kembali</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('pages.admin.menus._form')

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">Batal</a>
                <button type="submit" class="px-4 py-2 bg-amber-700 hover:bg-amber-800 text-white text-sm font-medium rounded-lg shadow transition">Perbarui Menu</button>
            </div>
        </form>
    </div>
</div>
@endsection