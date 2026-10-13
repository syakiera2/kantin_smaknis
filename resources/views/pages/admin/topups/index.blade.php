@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-[#5C4033]">Isi Saldo</h1>
        <p class="text-sm text-gray-600">Riwayat top up saldo pembeli</p>
    </div>
    <a href="{{ route('admin.topups.create') }}"
       class="inline-flex items-center gap-2 bg-[#7F5539] hover:bg-[#6a452d] text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow transition">
        <span class="text-lg leading-none">+</span> Isi Saldo Baru
    </a>
</div>

@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3 text-sm">
        {{ session('success') }}
    </div>
@endif

{{-- Ringkasan hari ini --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <p class="text-xs uppercase tracking-wide text-gray-500">Total Top Up Hari Ini</p>
        <p class="mt-1 text-2xl font-bold text-[#7F5539]">Rp {{ number_format($todayTotal, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <p class="text-xs uppercase tracking-wide text-gray-500">Jumlah Transaksi Hari Ini</p>
        <p class="mt-1 text-2xl font-bold text-[#7F5539]">{{ $todayCount }}</p>
    </div>
</div>

{{-- Filter --}}
<form method="GET" class="bg-white rounded-xl p-4 shadow-sm mb-4 grid grid-cols-1 md:grid-cols-4 gap-3">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / referensi"
           class="rounded-lg border-gray-300 text-sm focus:border-[#7F5539] focus:ring-[#7F5539]">
    <select name="method" class="rounded-lg border-gray-300 text-sm focus:border-[#7F5539] focus:ring-[#7F5539]">
        <option value="">Semua metode</option>
        <option value="cash" @selected(request('method') === 'cash')>Cash</option>
        <option value="digital" @selected(request('method') === 'digital')>Digital</option>
    </select>
    <input type="date" name="date" value="{{ request('date') }}"
           class="rounded-lg border-gray-300 text-sm focus:border-[#7F5539] focus:ring-[#7F5539]">
    <div class="flex gap-2">
        <button class="flex-1 bg-[#7F5539] hover:bg-[#6a452d] text-white text-sm font-semibold rounded-lg px-4 py-2">Filter</button>
        <a href="{{ route('admin.topups.index') }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg px-4 py-2">Reset</a>
    </div>
</form>

{{-- Tabel --}}
<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-[#E6CCB2] text-[#5C4033] text-left">
            <tr>
                <th class="px-4 py-3 font-semibold">Referensi</th>
                <th class="px-4 py-3 font-semibold">Pembeli</th>
                <th class="px-4 py-3 font-semibold">Nominal</th>
                <th class="px-4 py-3 font-semibold">Metode</th>
                <th class="px-4 py-3 font-semibold">Saldo Akhir</th>
                <th class="px-4 py-3 font-semibold">Waktu</th>
                <th class="px-4 py-3 font-semibold text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($topUps as $t)
                <tr class="hover:bg-[#FAF5F0]">
                    <td class="px-4 py-3 font-mono text-xs">{{ $t->reference }}</td>
                    <td class="px-4 py-3">{{ $t->user->name }}</td>
                    <td class="px-4 py-3 font-semibold text-green-700">+ Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            {{ $t->method === 'cash' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($t->method) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">Rp {{ number_format($t->balance_after, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $t->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.topups.show', $t) }}" class="text-[#7F5539] hover:underline font-medium">Struk</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-10 text-center text-gray-500">Belum ada transaksi isi saldo.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $topUps->links() }}</div>
@endsection