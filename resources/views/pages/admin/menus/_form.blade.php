@php
    $input = 'w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#7F5539] focus:outline-none focus:ring-1 focus:ring-[#7F5539]';
@endphp

@if ($errors->any())
    <div class="mb-4 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
        Terdapat kesalahan pada isian, silakan periksa kembali.
    </div>
@endif

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Nama Menu</label>
        <input type="text" name="nama" value="{{ old('nama', $menu->nama) }}" class="{{ $input }}" required>
        @error('nama') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Kategori</label>
        <select name="kategori" class="{{ $input }}" required>
            <option value="">-- Pilih --</option>
            @foreach ($kategoriList as $key => $label)
                <option value="{{ $key }}" @selected(old('kategori', $menu->kategori) === $key)>{{ $label }}</option>
            @endforeach
        </select>
        @error('kategori') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Harga (Rp)</label>
        <input type="number" name="harga" min="0" value="{{ old('harga', $menu->harga) }}" class="{{ $input }}" required>
        @error('harga') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Stok Harian</label>
        <input type="number" name="stok" min="0" value="{{ old('stok', $menu->stok) }}" class="{{ $input }}" required>
        @error('stok') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-end">
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_tersedia" value="1" class="h-4 w-4 rounded border-gray-300 text-[#7F5539] focus:ring-[#7F5539]"
                   @checked(old('is_tersedia', $menu->is_tersedia))>
            Menu aktif (tampil untuk pembeli)
        </label>
    </div>

    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Deskripsi (opsional)</label>
        <textarea name="deskripsi" rows="3" class="{{ $input }}">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-medium">Gambar (maks. 2 MB)</label>
        <div class="flex items-center gap-4">
            <img id="preview" src="{{ $menu->gambar_url }}" alt=""
                 class="h-20 w-20 rounded-lg object-cover {{ $menu->gambar_url ? '' : 'hidden' }}">
            <input type="file" name="gambar" accept="image/*"
                   class="text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-[#DDB892] file:px-4 file:py-2 file:text-sm file:font-semibold hover:file:bg-[#c9a57d]"
                   onchange="const f=this.files[0]; if(f){const p=document.getElementById('preview'); p.src=URL.createObjectURL(f); p.classList.remove('hidden');}">
        </div>
        @error('gambar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('admin.menus.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm hover:bg-gray-50">Batal</a>
    <button type="submit" class="rounded-lg bg-[#7F5539] px-5 py-2 text-sm font-semibold text-white hover:bg-[#6b4630]">Simpan</button>
</div>