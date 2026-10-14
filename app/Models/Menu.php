<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'category', 'price', 'stock', 'is_available'];

    protected $casts = ['is_available' => 'boolean'];
=======
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    public const KATEGORI = [
        'makanan' => 'Makanan',
        'minuman' => 'Minuman',
        'snack'   => 'Snack',
    ];

    protected $fillable = [
        'user_id', 'nama', 'kategori', 'deskripsi',
        'harga', 'stok', 'gambar', 'is_tersedia',
    ];

    protected $casts = [
        'harga'       => 'integer',
        'stok'        => 'integer',
        'is_tersedia' => 'boolean',
    ];

    // ---------- Relasi ----------
    public function penjual(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ---------- Scopes ----------
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, fn ($q) => $q->where('nama', 'like', "%{$term}%"));
    }

    public function scopeKategori(Builder $query, ?string $kategori): Builder
    {
        return $query->when($kategori, fn ($q) => $q->where('kategori', $kategori));
    }

    /** Menu yang bisa dibeli: aktif dan stok masih ada. */
    public function scopeTersedia(Builder $query): Builder
    {
        return $query->where('is_tersedia', true)->where('stok', '>', 0);
    }

    // ---------- Accessors ----------
    public function getHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getGambarUrlAttribute(): ?string
    {
        return $this->gambar ? Storage::disk('public')->url($this->gambar) : null;
    }

    /** Status real-time: Tersedia / Habis / Nonaktif */
    public function getStatusAttribute(): string
    {
        if (! $this->is_tersedia) {
            return 'Nonaktif';
        }

        return $this->stok > 0 ? 'Tersedia' : 'Habis';
    }
>>>>>>> 56e89d8718a02a104a0bffefd2cef6b5c4b062d2
}