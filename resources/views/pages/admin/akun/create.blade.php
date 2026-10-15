@extends('layouts.admin')

@section('content')
<div class="mt-6 max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-200">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Akun {{ ucfirst($role) }} Baru</h2>

    <form action="{{ route('admin.akun.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        <!-- Data Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" placeholder="Siswa123!" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700">Saldo Awal (Rp)</label>
                <input type="number" name="saldo_awal" value="0" class="w-full mt-1 p-2 border rounded-md">
            </div>
        </div>

        <!-- Form Tambahan Berdasarkan Role -->
        @if($role == 'siswa')
        <hr class="my-4">
        <h3 class="font-semibold text-gray-800">Detail Siswa</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-700">NISN</label>
                <input type="text" name="nisn" required class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">NIS</label>
                <input type="text" name="nis" required class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Kelas</label>
                <select name="kelas" class="w-full mt-1 p-2 border rounded-md">
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-700">Jurusan</label>
                <input type="text" name="jurusan" placeholder="RPL / TKJ / AKL" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full mt-1 p-2 border rounded-md">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        @elseif($role == 'guru')
        <hr class="my-4">
        <h3 class="font-semibold text-gray-800">Detail Guru / Pegawai</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-700">NIP / NIK</label>
                <input type="text" name="nip_nik" required class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Jabatan</label>
                <input type="text" name="jabatan" placeholder="Guru / Wali Kelas" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Nomor WhatsApp</label>
                <input type="text" name="nomor_telepon" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full mt-1 p-2 border rounded-md">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        @elseif($role == 'penjual')
        <hr class="my-4">
        <h3 class="font-semibold text-gray-800">Detail Stand / Tenant</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-700">Nama Stand / Toko</label>
                <input type="text" name="nama_stand" required class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Nomor Stand / Lokasi</label>
                <input type="text" name="nomor_stand" required class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Kategori Penjualan</label>
                <select name="kategori_penjualan" class="w-full mt-1 p-2 border rounded-md">
                    <option value="Makanan Berat">Makanan Berat</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Camilan/Snack">Camilan/Snack</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-700">No. Telp / WA</label>
                <input type="text" name="nomor_telepon" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Nama Bank</label>
                <input type="text" name="nama_bank" placeholder="BCA / Mandiri" class="w-full mt-1 p-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm text-gray-700">Nomor Rekening</label>
                <input type="text" name="nomor_rekening" class="w-full mt-1 p-2 border rounded-md">
            </div>
        </div>
        @endif

        <div class="pt-4">
            <label class="block text-sm text-gray-700">Foto Profil / Logo</label>
            <input type="file" name="foto_profil" class="w-full mt-1 p-1 border rounded-md">
        </div>

        <div class="flex justify-end space-x-2 pt-6">
            <a href="{{ route('admin.akun.index', ['role' => $role]) }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Batal</a>
            <button type="submit" class="px-4 py-2 bg-[#7F5539] text-white rounded-md hover:bg-[#9C6644]">Simpan Akun</button>
        </div>
    </form>
</div>
@endsection