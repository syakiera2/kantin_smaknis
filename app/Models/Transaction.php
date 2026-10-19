<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_code', 'user_id', 'buyer_name', 'total',
        'payment_method', 'status', 'paid_at',
    ];

    protected $casts = ['paid_at' => 'datetime'];

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function generateInvoiceCode(): string
    {
        return 'TRX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }
}