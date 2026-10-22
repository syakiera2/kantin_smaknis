{{-- Nama --}}
<div class="mb-4">
    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
    <input type="text" id="nama" name="nama" value="{{ old('nama', $menu->nama) }}"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 @error('nama') border-rose-500 @enderror">
    @error('nama')
        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
    @enderror
</div>

{{-- Kategori --}}
<div class="mb-4">
    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
    <select id="category_id" name="category_id"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 @error('category_id') border-rose-500 @enderror">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($kategoriList as $id => $name)
            <option value="{{ $id }}" @selected(old('category_id', $menu->category_id) == $id)>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
    @enderror
</div>

{{-- Deskripsi --}}
<div class="mb-4">
    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
    <textarea id="deskripsi" name="deskripsi" rows="3"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 @error('deskripsi') border-rose-500 @enderror">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
    @error('deskripsi')
        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
    @enderror
</div>

{{-- Harga & Stok --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
    <div>
        <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" min="0" value="{{ old('harga', $menu->harga) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 @error('harga') border-rose-500 @enderror">
        @error('harga')
            <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
        <input type="number" id="stok" name="stok" min="0" value="{{ old('stok', $menu->stok ?? 0) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 @error('stok') border-rose-500 @enderror">
        @error('stok')
            <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="min_stock" class="block text-sm font-medium text-gray-700 mb-1">Batas Stok Menipis</label>
        <input type="number" id="min_stock" name="min_stock" min="0" value="{{ old('min_stock', $menu->min_stock ?? 5) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 @error('min_stock') border-rose-500 @enderror">
        @error('min_stock')
            <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
        @enderror
    </div>
</div>

{{-- Gambar --}}
<div class="mb-4">
    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar (Opsional)</label>
    @if ($menu->gambar)
        <img src="{{ $menu->gambar_url }}" alt="{{ $menu->nama }}" class="w-24 h-24 object-cover rounded-lg mb-2">
    @endif
    <input type="file" id="gambar" name="gambar" accept="image/*"
        class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg @error('gambar') border-rose-500 @enderror">
    @error('gambar')
        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
    @enderror
</div>

{{-- Status --}}
<div class="mb-2">
    <input type="hidden" name="is_tersedia" value="0">
    <label class="inline-flex items-center text-sm text-gray-700">
        <input type="checkbox" name="is_tersedia" value="1" class="rounded border-gray-300 text-amber-600 focus:ring-amber-500"
            @checked(old('is_tersedia', $menu->is_tersedia))>
        <span class="ml-2">Menu aktif (bisa dipesan)</span>
    </label>
</div>