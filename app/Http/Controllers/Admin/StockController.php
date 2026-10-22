<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\StockMovement;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct(private StockService $stock) {}

    public function index(Request $request)
    {
        $menus = Menu::query()
            ->with('category')
            ->when($request->search, fn ($q, $s) => $q->where('nama', 'like', "%{$s}%"))
            ->when($request->status === 'low', fn ($q) => $q->lowStock())
            ->when($request->status === 'empty', fn ($q) => $q->empty())
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Menu::count(),
            'low'   => Menu::lowStock()->count(),
            'empty' => Menu::empty()->count(),
        ];

        return view('pages.admin.stock.index', compact('menus', 'stats'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'action'   => ['required', 'in:in,out,set'],
            'quantity' => ['required', 'integer', 'min:' . ($request->action === 'set' ? 0 : 1)],
            'note'     => ['nullable', 'string', 'max:255'],
        ]);

        match ($data['action']) {
            'in'  => $this->stock->change($menu, $data['quantity'], 'in', $data['note'] ?? null),
            'out' => $this->stock->change($menu, -$data['quantity'], 'out', $data['note'] ?? null),
            'set' => $this->stock->set($menu, $data['quantity'], $data['note'] ?? null),
        };

        return back()->with('success', "Stok {$menu->nama} berhasil diperbarui.");
    }

    public function daily()
    {
        $menus = Menu::with('category')->orderBy('nama')->get();

        return view('pages.admin.stock.daily', compact('menus'));
    }

    public function dailyStore(Request $request)
    {
        $data = $request->validate([
            'stocks'   => ['required', 'array'],
            'stocks.*' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($data['stocks'] as $menuId => $qty) {
            $menu = Menu::find($menuId);
            if ($menu && $menu->stok !== (int) $qty) {
                $this->stock->set($menu, (int) $qty, 'Stok awal harian');
            }
        }

        return redirect()->route('pages.admin.stock.index')
            ->with('success', 'Stok harian berhasil disimpan.');
    }

    public function history(Request $request)
    {
        $movements = StockMovement::with(['menu', 'user'])
            ->when($request->menu_id, fn ($q, $id) => $q->where('menu_id', $id))
            ->when($request->type, fn ($q, $t) => $q->where('type', $t))
            ->when($request->date, fn ($q, $d) => $q->whereDate('created_at', $d))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $menus = Menu::withTrashed()->orderBy('nama')->get(['id', 'nama']);

        return view('pages.admin.stock.history', compact('movements', 'menus'));
    }

    public function availability()
    {
        return response()->json(
            Menu::orderBy('nama')->get(['id', 'nama', 'harga', 'stok', 'is_tersedia'])
        );
    }
}