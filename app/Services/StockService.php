<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockService
{
    /** Tambah/kurangi stok. $qty positif = masuk, negatif = keluar. */
    public function change(Menu|int $menu, int $qty, string $type, ?string $note = null, ?int $userId = null): StockMovement
    {
        $menuId = $menu instanceof Menu ? $menu->id : $menu;

        return DB::transaction(function () use ($menuId, $qty, $type, $note, $userId) {
            // lock baris agar tidak terjadi stok minus saat transaksi bersamaan
            $menu = Menu::lockForUpdate()->findOrFail($menuId);

            $before = $menu->stock;
            $after  = $before + $qty;

            if ($after < 0) {
                throw ValidationException::withMessages([
                    'quantity' => "Stok {$menu->name} tidak cukup (sisa {$before}).",
                ]);
            }

            $menu->update([
                'stock'        => $after,
                'is_available' => $after > 0,
            ]);

            return StockMovement::create([
                'menu_id'      => $menu->id,
                'user_id'      => $userId ?? auth()->id(),
                'type'         => $type,
                'quantity'     => $qty,
                'stock_before' => $before,
                'stock_after'  => $after,
                'note'         => $note,
            ]);
        });
    }

    /** Set stok ke angka tertentu (stok awal harian / stok opname). */
    public function set(Menu|int $menu, int $newStock, ?string $note = null, ?int $userId = null): StockMovement
    {
        $menuId = $menu instanceof Menu ? $menu->id : $menu;

        return DB::transaction(function () use ($menuId, $newStock, $note, $userId) {
            $menu = Menu::lockForUpdate()->findOrFail($menuId);
            $diff = $newStock - $menu->stock;

            return $this->change($menu, $diff, 'set', $note, $userId);
        });
    }

    /** Dipanggil modul transaksi saat pembelian berhasil. */
    public function sell(Menu|int $menu, int $qty, ?string $invoice = null): StockMovement
    {
        return $this->change($menu, -$qty, 'sale', $invoice ? "Transaksi {$invoice}" : null);
    }
}