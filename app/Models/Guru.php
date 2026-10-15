<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['user_id', 'kode_pegawai', 'nip_nik', 'jabatan', 'nomor_telepon', 'jenis_kelamin'];

    public function user() { return $this->belongsTo(User::class); }
}