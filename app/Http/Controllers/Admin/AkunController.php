<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AkunController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->get('role', 'siswa');
        
        $users = User::where('role', $role)
            ->with(['siswa', 'guru', 'penjual'])
            ->latest()
            ->paginate(10);

        return view('pages.admin.akun.index', compact('users', 'role'));
    }

    public function create(Request $request)
    {
        $role = $request->get('role', 'siswa');
        return view('pages.admin.akun.create', compact('role'));
    }

    public function store(Request $request)
    {
        $role = $request->input('role');

        DB::beginTransaction();
        try {
            // Upload Foto Profil
            $fotoPath = null;
            if ($request->hasFile('foto_profil')) {
                $fotoPath = $request->file('foto_profil')->store('profil', 'public');
            }

            // 1. Simpan Data User Utama
            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password ?? 'Password123!'),
                'role' => $role,
                'saldo' => $request->saldo_awal ?? 0,
                'foto_profil' => $fotoPath,
            ]);

            // 2. Simpan Data Spesifik Berdasarkan Role
            if ($role === 'siswa') {
                $request->validate([
                    'nisn' => 'required|unique:siswa,nisn',
                    'nis' => 'required|unique:siswa,nis',
                ]);

                Siswa::create([
                    'user_id' => $user->id,
                    'kode_siswa' => 'SIS-' . date('Y') . '-' . sprintf('%03d', $user->id),
                    'nisn' => $request->nisn,
                    'nis' => $request->nis,
                    'kelas' => $request->kelas,
                    'jurusan' => $request->jurusan,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            } elseif ($role === 'guru') {
                $request->validate(['nip_nik' => 'required|unique:guru,nip_nik']);

                Guru::create([
                    'user_id' => $user->id,
                    'kode_pegawai' => 'PEG-' . date('Y') . '-' . sprintf('%03d', $user->id),
                    'nip_nik' => $request->nip_nik,
                    'jabatan' => $request->jabatan,
                    'nomor_telepon' => $request->nomor_telepon,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            } elseif ($role === 'penjual') {
                Penjual::create([
                    'user_id' => $user->id,
                    'kode_penjual' => 'TEN-' . sprintf('%03d', $user->id),
                    'nama_stand' => $request->nama_stand,
                    'nomor_stand' => $request->nomor_stand,
                    'kategori_penjualan' => $request->kategori_penjualan,
                    'nomor_telepon' => $request->nomor_telepon,
                    'nama_bank' => $request->nama_bank,
                    'nomor_rekening' => $request->nomor_rekening,
                ]);
            }

            DB::commit();
            return redirect()->route('admin.akun.index', ['role' => $role])
                ->with('success', 'Akun ' . ucfirst($role) . ' berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal membuat akun: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }
        $role = $user->role;
        $user->delete();

        return redirect()->route('admin.akun.index', ['role' => $role])
            ->with('success', 'Akun berhasil dihapus!');
    }
}