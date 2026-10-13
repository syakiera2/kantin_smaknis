<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'category', 'price', 'stock', 'min_stock', 'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function movements()
    {
        return $this->hasMany(StockMovement::class)->latest();
    }

    // Menipis: stok > 0 tapi <= batas minimum
    public function scopeLowStock(Builder $q): Builder
    {
        return $q->where('stock', '>', 0)->whereColumn('stock', '<=', 'min_stock');
    }

    public function scopeEmpty(Builder $q): Builder
    {
        return $q->where('stock', 0);
    }

    // $menu->stock_status => 'habis' | 'menipis' | 'tersedia'
    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) return 'habis';
        if ($this->stock <= $this->min_stock) return 'menipis';
        return 'tersedia';
    }
}