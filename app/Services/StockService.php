<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockService
{
    /** Tambah/kurangi stok. $delta positif = masuk, negatif = keluar. */
    public function change(Menu $menu, int $delta, string $type, ?string $note = null): StockMovement
    {
        return DB::transaction(function () use ($menu, $delta, $type, $note) {
            // lock baris supaya tidak bentrok kalau ada transaksi bersamaan
            $menu = Menu::whereKey($menu->id)->lockForUpdate()->firstOrFail();

            $before = $menu->stok;
            $after  = $before + $delta;

            if ($after < 0) {
                throw ValidationException::withMessages([
                    'quantity' => "Stok {$menu->nama} tidak cukup (tersisa {$before}).",
                ]);
            }

            $menu->update(['stok' => $after]);

            return StockMovement::create([
                'menu_id'      => $menu->id,
                'user_id'      => auth()->id(),
                'type'         => $type,
                'quantity'     => $delta,
                'stock_before' => $before,
                'stock_after'  => $after,
                'note'         => $note,
            ]);
        });
    }

    /** Set stok ke angka tertentu (stok awal harian). */
    public function set(Menu $menu, int $quantity, ?string $note = null): StockMovement
    {
        return DB::transaction(function () use ($menu, $quantity, $note) {
            $menu = Menu::whereKey($menu->id)->lockForUpdate()->firstOrFail();

            $before = $menu->stok;

            $menu->update(['stok' => $quantity]);

            return StockMovement::create([
                'menu_id'      => $menu->id,
                'user_id'      => auth()->id(),
                'type'         => 'set',
                'quantity'     => $quantity - $before,
                'stock_before' => $before,
                'stock_after'  => $quantity,
                'note'         => $note,
            ]);
        });
    }
}