<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopUp;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TopUpController extends Controller
{
    /**
     * Riwayat isi saldo + filter.
     */
    public function index(Request $request): View
    {
        $topUps = TopUp::with(['user', 'processor'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->q;
                $query->where(function ($sub) use ($q) {
                    $sub->where('reference', 'like', "%{$q}%")
                        ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$q}%"));
                });
            })
            ->when($request->filled('method'), fn ($query) => $query->where('method', $request->method))
            ->when($request->filled('date'), fn ($query) => $query->whereDate('created_at', $request->date))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $todayTotal = TopUp::where('status', TopUp::STATUS_SUCCESS)
            ->whereDate('created_at', today())
            ->sum('amount');

        $todayCount = TopUp::where('status', TopUp::STATUS_SUCCESS)
            ->whereDate('created_at', today())
            ->count();

        return view('pages.admin.topups.index', compact('topUps', 'todayTotal', 'todayCount'));
    }

    /**
     * Form isi saldo.
     */
    public function create(): View
    {
        // Sesuaikan filter role dengan aplikasi Anda (mis. 'siswa' / 'pembeli').
        $buyers = User::query()
            ->with('wallet')
            ->where('role', 'pembeli')
            ->orderBy('name')
            ->get();

        return view('pages.admin.topups.create', compact('buyers'));
    }

    /**
     * Proses isi saldo (atomic + row lock agar saldo tidak balapan).
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'amount'  => ['required', 'integer', 'min:1000', 'max:1000000'],
            'method'  => ['required', 'in:cash,digital'],
            'note'    => ['nullable', 'string', 'max:255'],
        ], [
            'user_id.required' => 'Pilih pembeli terlebih dahulu.',
            'amount.min'       => 'Minimal isi saldo Rp 1.000.',
            'amount.max'       => 'Maksimal isi saldo Rp 1.000.000 per transaksi.',
        ]);

        $topUp = DB::transaction(function () use ($data, $request) {
            // Pastikan wallet ada, lalu kunci barisnya.
            Wallet::firstOrCreate(['user_id' => $data['user_id']], ['balance' => 0]);

            $wallet = Wallet::where('user_id', $data['user_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $before = $wallet->balance;
            $wallet->credit((int) $data['amount']);

            return TopUp::create([
                'reference'      => TopUp::generateReference(),
                'wallet_id'      => $wallet->id,
                'user_id'        => $data['user_id'],
                'processed_by'   => $request->user()->id,
                'amount'         => $data['amount'],
                'balance_before' => $before,
                'balance_after'  => $wallet->balance,
                'method'         => $data['method'],
                'status'         => TopUp::STATUS_SUCCESS,
                'note'           => $data['note'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.topups.show', $topUp)
            ->with('success', 'Saldo berhasil ditambahkan.');
    }

    /**
     * Bukti isi saldo (struk).
     */
    public function show(TopUp $topUp): View
    {
        $topUp->load(['user', 'processor']);

        return view('admin.topups.show', compact('topUp'));
    }
}