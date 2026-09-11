@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Judul & Tombol Kembali --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-[#0A2540]">
            Detail Transaksi #{{ $penjualan->id }}
        </h1>
        <a href="{{ route('penjualan.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-xl shadow transition font-semibold">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    {{-- Informasi Transaksi Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8 mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-sm text-gray-500 mb-1">Kasir / Petugas</p>
            <p class="text-lg font-bold text-gray-800">{{ $penjualan->user->name ?? '-' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Tanggal Transaksi</p>
            <p class="text-lg font-bold text-gray-800">{{ $penjualan->created_at }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Status Pembayaran</p>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold 
                {{ $penjualan->status == 'COMPLETED' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                {{ $penjualan->status }}
            </span>
        </div>

        <div>
            <p class="text-sm text-gray-500 mb-1">Metode Pembayaran</p>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                {{ $penjualan->metode_pembayaran }}
            </span>
        </div>

        @if($penjualan->metode_pembayaran === 'CASH')
        <div>
            <p class="text-sm text-gray-500 mb-1">Uang Dibayar</p>
            <p class="text-lg font-bold text-gray-800">Rp {{ number_format($penjualan->uang_dibayar ?? $penjualan->total_pembayaran, 0, ',', '.') }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500 mb-1">Kembalian</p>
            <p class="text-lg font-bold text-emerald-700">Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}</p>
        </div>
        @endif
    </div>

    {{-- Tabel Item Produk yang Dibeli --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden p-6">
        <h2 class="text-xl font-bold text-[#0A2540] mb-4">Daftar Item Produk</h2>

        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-500">
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Nama Produk</th>
                    <th class="px-6 py-4">Harga Satuan</th>
                    <th class="px-6 py-4">Qty</th>
                    <th class="px-6 py-4 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan->itemPenjualan as $index => $item)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $item->produk->nama ?? 'Produk Dihapus' }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($item->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $item->kuantitas }}</td>
                    <td class="px-6 py-4 text-right font-bold text-[#0A2540]">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">Tidak ada item dalam transaksi ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Total Keseluruhan --}}
        <div class="border-t border-gray-200 mt-6 pt-4 flex justify-between items-center px-4">
            <span class="text-lg font-bold text-gray-700">Total Pembayaran:</span>
            <span class="text-2xl font-bold text-[#0A2540]">Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</span>
        </div>
    </div>

</div>

@endsection
