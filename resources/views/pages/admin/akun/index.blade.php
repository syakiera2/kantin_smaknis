@extends('layouts.admin')

@section('content')
<div class="mt-6">
    <!-- Header & Action -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Akun Modul</h1>
            <p class="text-sm text-gray-600">Kelola pengguna berdasarkan kategorinya.</p>
        </div>
        <a href="{{ route('admin.akun.create', ['role' => $role]) }}" 
           class="inline-flex items-center justify-center px-4 py-2 bg-[#7F5539] hover:bg-[#9C6644] text-white rounded-lg font-semibold transition">
            + Tambah {{ ucfirst($role) }}
        </a>
    </div>

    <!-- Tab Filter Role -->
    <div class="flex border-b border-gray-300 mb-6 space-x-4">
        <a href="{{ route('admin.akun.index', ['role' => 'siswa']) }}" 
           class="pb-2 font-semibold {{ $role == 'siswa' ? 'text-[#7F5539] border-b-2 border-[#7F5539]' : 'text-gray-500 hover:text-gray-700' }}">
            Siswa
        </a>
        <a href="{{ route('admin.akun.index', ['role' => 'guru']) }}" 
           class="pb-2 font-semibold {{ $role == 'guru' ? 'text-[#7F5539] border-b-2 border-[#7F5539]' : 'text-gray-500 hover:text-gray-700' }}">
            Guru / Pegawai
        </a>
        <a href="{{ route('admin.akun.index', ['role' => 'penjual']) }}" 
           class="pb-2 font-semibold {{ $role == 'penjual' ? 'text-[#7F5539] border-b-2 border-[#7F5539]' : 'text-gray-500 hover:text-gray-700' }}">
            Penjual / Tenant
        </a>
    </div>

    <!-- Alert Status -->
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Data Pengguna -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-[#DDB892] text-gray-800 font-semibold uppercase text-xs">
                <tr>
                    <th class="p-4">Pengguna</th>
                    <th class="p-4">ID Unik</th>
                    @if($role == 'siswa')
                        <th class="p-4">NISN / NIS</th>
                        <th class="p-4">Kelas & Jurusan</th>
                    @elseif($role == 'guru')
                        <th class="p-4">NIP / NIK</th>
                        <th class="p-4">Jabatan</th>
                    @elseif($role == 'penjual')
                        <th class="p-4">Nama Stand</th>
                        <th class="p-4">Kategori & No. Stand</th>
                    @endif
                    <th class="p-4">Saldo</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 flex items-center space-x-3">
                        <img class="w-10 h-10 rounded-full object-cover bg-gray-200" 
                             src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                             alt="Avatar">
                        <div>
                            <div class="font-bold text-gray-800">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                        </div>
                    </td>

                    <!-- ID Unik Per Role -->
                    <td class="p-4 font-mono text-xs font-bold text-gray-700">
                        @if($role == 'siswa') {{ $user->siswa->kode_siswa ?? '-' }}
                        @elseif($role == 'guru') {{ $user->guru->kode_pegawai ?? '-' }}
                        @elseif($role == 'penjual') {{ $user->penjual->kode_penjual ?? '-' }}
                        @endif
                    </td>

                    <!-- Atribut Tambahan -->
                    @if($role == 'siswa')
                        <td class="p-4">{{ $user->siswa->nisn ?? '-' }} / {{ $user->siswa->nis ?? '-' }}</td>
                        <td class="p-4">{{ $user->siswa->kelas ?? '-' }} - {{ $user->siswa->jurusan ?? '-' }}</td>
                    @elseif($role == 'guru')
                        <td class="p-4">{{ $user->guru->nip_nik ?? '-' }}</td>
                        <td class="p-4">{{ $user->guru->jabatan ?? '-' }}</td>
                    @elseif($role == 'penjual')
                        <td class="p-4 font-semibold text-gray-800">{{ $user->penjual->nama_stand ?? '-' }}</td>
                        <td class="p-4">{{ $user->penjual->kategori_penjualan ?? '-' }} (Stand {{ $user->penjual->nomor_stand ?? '-' }})</td>
                    @endif

                    <td class="p-4 font-semibold text-green-700">
                        Rp {{ number_format($user->saldo, 0, ',', '.') }}
                    </td>

                    <td class="p-4 text-center space-x-2">
                        <form action="{{ route('admin.akun.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus akun ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">Belum ada data {{ $role }}.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection