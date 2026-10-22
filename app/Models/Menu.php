<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'min_stock',
        'gambar',
        'is_tersedia',
    ];

    protected $casts = [
        'harga'       => 'integer',
        'stok'        => 'integer',
        'min_stock'   => 'integer',
        'is_tersedia' => 'boolean',
    ];

    // ---------- Relasi ----------
    public function penjual(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    // ---------- Scopes ----------
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, fn ($q) => $q->where('nama', 'like', "%{$term}%"));
    }

    public function scopeKategori(Builder $query, $categoryId): Builder
    {
        return $query->when($categoryId, fn ($q) => $q->where('category_id', $categoryId));
    }

    public function scopeTersedia(Builder $query): Builder
    {
        return $query->where('is_tersedia', true)->where('stok', '>', 0);
    }

    public function scopeLowStock(Builder $query): Builder
    {
        return $query->where('stok', '<=', 5);
    }

    public function scopeEmpty(Builder $query): Builder
    {
        return $query->where('stok', 0);
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

    public function getStatusAttribute(): string
    {
        if (! $this->is_tersedia) {
            return 'Nonaktif';
        }

        return $this->stok > 0 ? 'Tersedia' : 'Habis';
    }
}