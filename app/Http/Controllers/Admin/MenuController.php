<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $menus = Menu::query()
            ->with('category')
            ->search($request->query('q'))
            ->kategori($request->query('kategori'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total'    => Menu::count(),
            'tersedia' => Menu::tersedia()->count(),
            'habis'    => Menu::where('stok', 0)->count(),
        ];

        return view('pages.admin.menus.index', [
            'menus'        => $menus,
            'stats'        => $stats,
            'kategoriList' => Category::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.menus.create', [
            'menu'         => new Menu(['is_tersedia' => true, 'stok' => 0]),
            'kategoriList' => Category::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function store(MenuRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()?->id;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu): View
    {
        return view('pages.admin.menus.edit', [
            'menu'         => $menu,
            'kategoriList' => Category::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menus', 'public');
        } else {
            unset($data['gambar']);
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil dihapus.');
    }

    public function toggle(Menu $menu): RedirectResponse
    {
        $menu->update(['is_tersedia' => ! $menu->is_tersedia]);

        return back()->with('success', "Menu \"{$menu->nama}\" kini " . ($menu->is_tersedia ? 'aktif.' : 'nonaktif.'));
    }
}