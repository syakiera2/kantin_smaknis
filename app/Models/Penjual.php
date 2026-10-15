<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    protected $table = 'penjual';
    protected $fillable = ['user_id', 'kode_penjual', 'nama_stand', 'nomor_stand', 'kategori_penjualan', 'nomor_telepon', 'nama_bank', 'nomor_rekening'];

    public function user() { return $this->belongsTo(User::class); }
}