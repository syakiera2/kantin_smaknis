@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto">
    <div class="mb-4 flex items-center justify-between print:hidden">
        <a href="{{ route('admin.topups.index') }}" class="text-sm text-[#7F5539] hover:underline">&larr; Kembali</a>
        <button onclick="window.print()"
                class="bg-[#7F5539] hover:bg-[#6a452d] text-white text-sm font-semibold px-4 py-2 rounded-lg shadow transition">
            Cetak Struk
        </button>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3 text-sm print:hidden">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm p-6 font-mono text-sm">
        <div class="text-center border-b border-dashed border-gray-300 pb-4">
            <h2 class="text-lg font-bold">KANTIN SMAKNIS</h2>
            <p class="text-xs text-gray-500">Bukti Isi Saldo</p>
        </div>

        <dl class="py-4 space-y-2 border-b border-dashed border-gray-300">
            <div class="flex justify-between"><dt class="text-gray-500">Referensi</dt><dd>{{ $topUp->reference }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Waktu</dt><dd>{{ $topUp->created_at->format('d/m/Y H:i') }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Pembeli</dt><dd>{{ $topUp->user->name }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Metode</dt><dd>{{ ucfirst($topUp->method) }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Petugas</dt><dd>{{ $topUp->processor->name ?? '-' }}</dd></div>
        </dl>

        <dl class="py-4 space-y-2 border-b border-dashed border-gray-300">
            <div class="flex justify-between"><dt class="text-gray-500">Saldo Awal</dt><dd>Rp {{ number_format($topUp->balance_before, 0, ',', '.') }}</dd></div>
            <div class="flex justify-between font-bold text-base"><dt>Top Up</dt><dd class="text-green-700">+ Rp {{ number_format($topUp->amount, 0, ',', '.') }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Saldo Akhir</dt><dd class="font-bold">Rp {{ number_format($topUp->balance_after, 0, ',', '.') }}</dd></div>
        </dl>

        @if ($topUp->note)
            <p class="pt-4 text-xs text-gray-500">Catatan: {{ $topUp->note }}</p>
        @endif

        <p class="pt-4 text-center text-xs text-gray-400">Terima kasih. Simpan struk ini sebagai bukti.</p>
    </div>
</div>
@endsection