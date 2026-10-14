<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionMonitorController extends Controller
{
    // Halaman utama monitor
    public function index()
    {
        return view('pages.admin.monitor.index');
    }

    // Endpoint JSON yang di-polling oleh frontend
    public function data(Request $request): JsonResponse
    {
        $stats = [
            'total_transaksi'  => Transaction::today()->count(),
            'total_pendapatan' => (int) Transaction::today()->where('status', 'paid')->sum('total'),
            'cash'             => (int) Transaction::today()->where('status', 'paid')->where('payment_method', 'cash')->sum('total'),
            'digital'          => (int) Transaction::today()->where('status', 'paid')->where('payment_method', 'digital')->sum('total'),
            'pending'          => Transaction::today()->where('status', 'pending')->count(),
        ];

        $transactions = Transaction::with('items')
            ->today()
            ->latest()
            ->limit(20)
            ->get()
            ->map(fn (Transaction $t) => [
                'id'             => $t->id,
                'invoice_code'   => $t->invoice_code,
                'buyer_name'     => $t->buyer_name,
                'items'          => $t->items->map(fn ($i) => $i->menu_name . ' x' . $i->quantity)->implode(', '),
                'total'          => $t->total,
                'payment_method' => $t->payment_method,
                'status'         => $t->status,
                'time'           => $t->created_at->format('H:i:s'),
            ]);

        $lowStock = Menu::where('stock', '<=', 5)
            ->orderBy('stock')
            ->limit(8)
            ->get(['id', 'name', 'stock']);

        return response()->json([
            'stats'        => $stats,
            'transactions' => $transactions,
            'low_stock'    => $lowStock,
            'updated_at'   => now()->format('H:i:s'),
        ]);
    }
}