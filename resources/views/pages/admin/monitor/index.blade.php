@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- Judul --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-[#5C4033]">Pantau Transaksi</h1>
            <p class="text-sm text-gray-600">Data hari ini, diperbarui otomatis setiap 5 detik</p>
        </div>
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
            </span>
            Live &middot; <span id="updated-at">--:--:--</span>
        </div>
    </div>

    {{-- Kartu statistik --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-xs text-gray-500">Total Transaksi</p>
            <p id="stat-total" class="text-2xl font-bold mt-1">0</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-xs text-gray-500">Pendapatan</p>
            <p id="stat-pendapatan" class="text-2xl font-bold mt-1">Rp 0</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-xs text-gray-500">Cash</p>
            <p id="stat-cash" class="text-2xl font-bold mt-1">Rp 0</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-xs text-gray-500">Digital</p>
            <p id="stat-digital" class="text-2xl font-bold mt-1">Rp 0</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-xs text-gray-500">Menunggu Bayar</p>
            <p id="stat-pending" class="text-2xl font-bold mt-1 text-yellow-600">0</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Tabel transaksi --}}
        <div class="xl:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b font-semibold">Transaksi Terbaru</div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-left text-gray-500">
                        <tr>
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Invoice</th>
                            <th class="px-4 py-3">Pembeli</th>
                            <th class="px-4 py-3">Pesanan</th>
                            <th class="px-4 py-3">Metode</th>
                            <th class="px-4 py-3 text-right">Total</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody id="transaction-body" class="divide-y">
                        <tr><td colspan="7" class="px-4 py-8 text-center text-gray-400">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Stok menipis --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b font-semibold">Stok Menipis</div>
            <ul id="low-stock" class="divide-y text-sm">
                <li class="px-5 py-4 text-gray-400">Memuat data...</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const DATA_URL = "{{ route('admin.monitor.data') }}";
    const INTERVAL = 5000;
    let knownIds = null; // null = load pertama, jangan di-highlight

    const rupiah = (n) => 'Rp ' + Number(n).toLocaleString('id-ID');
    const esc = (s) => String(s).replace(/[&<>"']/g, c => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    }[c]));

    const statusBadge = {
        paid:      '<span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Lunas</span>',
        pending:   '<span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">Menunggu</span>',
        cancelled: '<span class="px-2 py-1 rounded-full text-xs bg-red-100 text-red-700">Dibatalkan</span>',
    };

    function renderStats(s) {
        document.getElementById('stat-total').textContent = s.total_transaksi;
        document.getElementById('stat-pendapatan').textContent = rupiah(s.total_pendapatan);
        document.getElementById('stat-cash').textContent = rupiah(s.cash);
        document.getElementById('stat-digital').textContent = rupiah(s.digital);
        document.getElementById('stat-pending').textContent = s.pending;
    }

    function renderTransactions(list) {
        const body = document.getElementById('transaction-body');

        if (!list.length) {
            body.innerHTML = '<tr><td colspan="7" class="px-4 py-8 text-center text-gray-400">Belum ada transaksi hari ini</td></tr>';
            return;
        }

        const currentIds = list.map(t => t.id);

        body.innerHTML = list.map(t => {
            const isNew = knownIds !== null && !knownIds.includes(t.id);
            return `
            <tr class="${isNew ? 'bg-amber-50' : ''}">
                <td class="px-4 py-3 whitespace-nowrap">${esc(t.time)}</td>
                <td class="px-4 py-3 font-mono text-xs">${esc(t.invoice_code)}</td>
                <td class="px-4 py-3">${esc(t.buyer_name)}</td>
                <td class="px-4 py-3 max-w-xs truncate" title="${esc(t.items)}">${esc(t.items)}</td>
                <td class="px-4 py-3 capitalize">${esc(t.payment_method)}</td>
                <td class="px-4 py-3 text-right font-medium">${rupiah(t.total)}</td>
                <td class="px-4 py-3">${statusBadge[t.status] ?? esc(t.status)}</td>
            </tr>`;
        }).join('');

        knownIds = currentIds;
    }

    function renderLowStock(list) {
        const el = document.getElementById('low-stock');
        if (!list.length) {
            el.innerHTML = '<li class="px-5 py-4 text-gray-400">Semua stok aman</li>';
            return;
        }
        el.innerHTML = list.map(m => `
            <li class="px-5 py-3 flex justify-between">
                <span>${esc(m.name)}</span>
                <span class="${m.stock === 0 ? 'text-red-600' : 'text-yellow-600'} font-semibold">
                    ${m.stock === 0 ? 'Habis' : 'Sisa ' + m.stock}
                </span>
            </li>`).join('');
    }

    async function fetchData() {
        try {
            const res = await fetch(DATA_URL, { headers: { 'Accept': 'application/json' } });
            if (!res.ok) throw new Error(res.status);
            const data = await res.json();

            renderStats(data.stats);
            renderTransactions(data.transactions);
            renderLowStock(data.low_stock);
            document.getElementById('updated-at').textContent = data.updated_at;
        } catch (e) {
            console.error('Gagal memuat data monitor:', e);
        }
    }

    fetchData();
    setInterval(fetchData, INTERVAL);
</script>
@endpush