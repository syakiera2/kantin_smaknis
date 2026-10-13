<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'menu_id', 'user_id', 'type', 'quantity',
        'stock_before', 'stock_after', 'note',
    ];

    public const TYPES = [
        'in'   => 'Stok Masuk',
        'out'  => 'Stok Keluar',
        'set'  => 'Stok Harian',
        'sale' => 'Penjualan',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }
}