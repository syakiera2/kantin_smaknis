@extends('layouts.admin')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.topups.index') }}" class="text-sm text-[#7F5539] hover:underline">&larr; Kembali</a>
        <h1 class="text-2xl font-bold text-[#5C4033] mt-1">Isi Saldo Pembeli</h1>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.topups.store') }}" class="bg-white rounded-xl shadow-sm p-6 space-y-5"
          x-data="{ amount: '{{ old('amount') }}' }">
        @csrf

        {{-- Pembeli --}}
        <div>
            <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-1">Pembeli</label>
            <select id="user_id" name="user_id" required
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-[#7F5539] focus:ring-[#7F5539]">
                <option value="">-- Pilih pembeli --</option>
                @foreach ($buyers as $buyer)
                    <option value="{{ $buyer->id }}" @selected(old('user_id') == $buyer->id)>
                        {{ $buyer->name }} (Saldo: Rp {{ number_format($buyer->wallet->balance ?? 0, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nominal --}}
        <div>
            <label for="amount" class="block text-sm font-semibold text-gray-700 mb-1">Nominal (Rp)</label>
            <input id="amount" type="number" name="amount" min="1000" max="1000000" step="1000"
                   value="{{ old('amount') }}" required placeholder="contoh: 20000"
                   class="w-full rounded-lg border-gray-300 text-sm focus:border-[#7F5539] focus:ring-[#7F5539]">
            <div class="flex flex-wrap gap-2 mt-2">
                @foreach ([5000, 10000, 20000, 50000, 100000] as $preset)
                    <button type="button"
                            onclick="document.getElementById('amount').value = {{ $preset }}"
                            class="px-3 py-1.5 rounded-full bg-[#EDE0D4] hover:bg-[#E6CCB2] text-[#5C4033] text-xs font-semibold transition">
                        {{ number_format($preset, 0, ',', '.') }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Metode --}}
        <div>
            <span class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran</span>
            <div class="grid grid-cols-2 gap-3">
                <label class="flex items-center gap-2 border rounded-lg px-4 py-3 cursor-pointer hover:bg-[#FAF5F0] has-[:checked]:border-[#7F5539] has-[:checked]:bg-[#FAF5F0]">
                    <input type="radio" name="method" value="cash" class="text-[#7F5539] focus:ring-[#7F5539]"
                           @checked(old('method', 'cash') === 'cash')>
                    <span class="text-sm font-medium">Cash</span>
                </label>
                <label class="flex items-center gap-2 border rounded-lg px-4 py-3 cursor-pointer hover:bg-[#FAF5F0] has-[:checked]:border-[#7F5539] has-[:checked]:bg-[#FAF5F0]">
                    <input type="radio" name="method" value="digital" class="text-[#7F5539] focus:ring-[#7F5539]"
                           @checked(old('method') === 'digital')>
                    <span class="text-sm font-medium">Digital (QRIS / Transfer)</span>
                </label>
            </div>
        </div>

        {{-- Catatan --}}
        <div>
            <label for="note" class="block text-sm font-semibold text-gray-700 mb-1">Catatan <span class="font-normal text-gray-400">(opsional)</span></label>
            <input id="note" type="text" name="note" maxlength="255" value="{{ old('note') }}"
                   class="w-full rounded-lg border-gray-300 text-sm focus:border-[#7F5539] focus:ring-[#7F5539]">
        </div>

        <div class="pt-2 flex gap-3">
            <button type="submit"
                    class="bg-[#7F5539] hover:bg-[#6a452d] text-white text-sm font-semibold px-6 py-2.5 rounded-lg shadow transition">
                Proses Isi Saldo
            </button>
            <a href="{{ route('admin.topups.index') }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-6 py-2.5 rounded-lg transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection