<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use InvalidArgumentException;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'balance'];

    protected $casts = [
        'balance' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function topUps(): HasMany
    {
        return $this->hasMany(TopUp::class);
    }

    /**
     * Tambah saldo. Panggil di dalam DB::transaction dan pada
     * instance yang sudah di-lock (lockForUpdate).
     */
    public function credit(int $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException('Nominal harus lebih dari 0.');
        }

        $this->balance += $amount;
        $this->save();
    }

    /**
     * Kurangi saldo (dipakai nanti oleh modul transaksi pembelian).
     */
    public function debit(int $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException('Nominal harus lebih dari 0.');
        }

        if ($this->balance < $amount) {
            throw new InvalidArgumentException('Saldo tidak mencukupi.');
        }

        $this->balance -= $amount;
        $this->save();
    }

    public function getFormattedBalanceAttribute(): string
    {
        return 'Rp ' . number_format($this->balance, 0, ',', '.');
    }
}