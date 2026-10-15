<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['user_id', 'kode_siswa', 'nisn', 'nis', 'kelas', 'jurusan', 'jenis_kelamin'];

    public function user() { return $this->belongsTo(User::class); }
}