@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
@php
    $queryEkspor = request()->only(['jenis', 'tanggal', 'bulan', 'tanggal_awal', 'tanggal_akhir', 'kasir_id', 'metode_pembayaran', 'search']);
    $isKasir = strtolower((string) optional(auth()->user()->role)->name) === 'kasir';
@endphp

<div class="space-y-6">
    <x-page-header
        title="Laporan Penjualan"
        subtitle="Filter, periksa, lalu ekspor data penjualan dengan hasil yang konsisten."
        label="Sales Report"
        icon="fa-chart-column" />

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-700 dark:bg-slate-800">
        <form action="{{ route('laporan.index') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Jenis Periode</label>
                <select name="jenis" id="jenis-periode" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                    <option value="harian" @selected($filters['jenis'] === 'harian')>Harian</option>
                    <option value="mingguan" @selected($filters['jenis'] === 'mingguan')>Mingguan</option>
                    <option value="bulanan" @selected($filters['jenis'] === 'bulanan')>Bulanan</option>
                    <option value="rentang" @selected($filters['jenis'] === 'rentang')>Rentang Khusus</option>
                </select>
            </div>

            <div data-filter="tanggal" class="{{ in_array($filters['jenis'], ['bulanan', 'rentang']) ? 'hidden' : '' }}">
                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Tanggal Acuan</label>
                <input type="date" name="tanggal" value="{{ $filters['tanggal'] ?? now()->format('Y-m-d') }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
            </div>

            <div data-filter="bulan" class="{{ $filters['jenis'] !== 'bulanan' ? 'hidden' : '' }}">
                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Bulan</label>
                <input type="month" name="bulan" value="{{ $filters['bulan'] ?? now()->format('Y-m') }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
            </div>

            <div data-filter="rentang" class="{{ $filters['jenis'] !== 'rentang' ? 'hidden' : '' }}">
                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" value="{{ $filters['tanggal_awal'] ?? now()->startOfMonth()->format('Y-m-d') }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
            </div>

            <div data-filter="rentang" class="{{ $filters['jenis'] !== 'rentang' ? 'hidden' : '' }}">
                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" value="{{ $filters['tanggal_akhir'] ?? now()->format('Y-m-d') }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
            </div>

            @unless($isKasir)
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Kasir/Pengguna</label>
                    <select name="kasir_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                        <option value="">Semua pengguna</option>
                        @foreach($kasirList as $kasir)
                            <option value="{{ $kasir->id }}" @selected((string) ($filters['kasir_id'] ?? '') === (string) $kasir->id)>{{ $kasir->name }} — {{ optional($kasir->role)->name ?? '-' }}</option>
                        @endforeach
                    </select>
                </div>
            @endunless

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                    <option value="">Semua metode</option>
                    @foreach(['CASH', 'TRANSFER', 'QRIS'] as $metode)
                        <option value="{{ $metode }}" @selected(($filters['metode_pembayaran'] ?? '') === $metode)>{{ $metode }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Cari ID/Kasir</label>
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Contoh: 12 atau ADIT" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
            </div>

            <div class="flex items-end gap-2">
                <button class="flex-1 rounded-xl bg-[#0A2540] px-5 py-3 font-semibold text-white transition hover:bg-[#12395f]">
                    <i class="fa-solid fa-filter mr-2"></i>Terapkan
                </button>
                <a href="{{ route('laporan.index') }}" title="Reset filter" class="rounded-xl bg-slate-100 px-4 py-3 text-slate-600 hover:bg-slate-200 dark:bg-slate-700 dark:text-slate-200">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </form>

        @if($errors->any())
            <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $errors->first() }}</div>
        @endif
    </div>

    <div class="flex flex-col gap-4 rounded-3xl border border-blue-100 bg-blue-50 p-5 dark:border-blue-900 dark:bg-blue-950/30 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-medium text-blue-700 dark:text-blue-300">Periode aktif</p>
            <h2 class="mt-1 text-2xl font-bold text-[#0A2540] dark:text-white">{{ $periode }}</h2>
            <p class="mt-1 text-xs text-blue-600 dark:text-blue-400">Kode referensi: <span class="font-mono font-bold">{{ $verificationCode }}</span> · dibuat {{ $generatedAt->format('d-m-Y H:i') }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('laporan.export.pdf', $queryEkspor) }}" class="rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-red-700">
                <i class="fa-solid fa-file-pdf mr-2"></i>Ekspor PDF
            </a>
            <a href="{{ route('laporan.export.excel', $queryEkspor) }}" class="rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-emerald-700">
                <i class="fa-solid fa-file-excel mr-2"></i>Ekspor Excel
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow dark:border-slate-700 dark:bg-slate-800"><p class="text-sm text-slate-500">Total Pendapatan</p><p class="mt-2 text-2xl font-bold text-[#0A2540] dark:text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p></div>
        <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow dark:border-slate-700 dark:bg-slate-800"><p class="text-sm text-slate-500">Jumlah Transaksi</p><p class="mt-2 text-2xl font-bold text-[#0A2540] dark:text-white">{{ number_format($totalTransaksi) }}</p></div>
        <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow dark:border-slate-700 dark:bg-slate-800"><p class="text-sm text-slate-500">Produk Terjual</p><p class="mt-2 text-2xl font-bold text-[#0A2540] dark:text-white">{{ number_format($totalProdukTerjual) }} pcs</p></div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        @foreach(['CASH' => 'fa-money-bill-wave', 'TRANSFER' => 'fa-building-columns', 'QRIS' => 'fa-qrcode'] as $metode => $ikon)
            <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center justify-between"><div><p class="font-semibold text-slate-700 dark:text-slate-200">{{ $metode }}</p><p class="text-xs text-slate-500">{{ $pembayaran[$metode]['jumlah'] }} transaksi</p></div><i class="fa-solid {{ $ikon }} text-xl text-blue-600"></i></div>
                <p class="mt-4 text-xl font-bold text-[#0A2540] dark:text-white">Rp {{ number_format($pembayaran[$metode]['total'], 0, ',', '.') }}</p>
            </div>
        @endforeach
    </div>

    <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-lg dark:border-slate-700 dark:bg-slate-800">
        <div class="border-b border-slate-100 px-6 py-5 dark:border-slate-700"><h3 class="text-lg font-bold text-[#0A2540] dark:text-white">Rincian Transaksi</h3><p class="text-sm text-slate-500">Data berikut sama dengan data di file PDF dan Excel.</p></div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase text-slate-500 dark:bg-slate-700/50 dark:text-slate-300"><tr><th class="px-5 py-4">ID</th><th class="px-5 py-4">Tanggal</th><th class="px-5 py-4">Kasir</th><th class="px-5 py-4">Metode</th><th class="px-5 py-4 text-center">Item</th><th class="px-5 py-4 text-right">Total</th></tr></thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($penjualan as $transaksi)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/40"><td class="px-5 py-4 font-semibold">#{{ $transaksi->id }}</td><td class="px-5 py-4">{{ $transaksi->created_at->format('d-m-Y H:i') }}</td><td class="px-5 py-4">{{ optional($transaksi->user)->name ?? '-' }}</td><td class="px-5 py-4"><span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">{{ $transaksi->metode_pembayaran }}</span></td><td class="px-5 py-4 text-center">{{ $transaksi->itemPenjualan->sum('kuantitas') }}</td><td class="px-5 py-4 text-right font-bold">Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td></tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-12 text-center text-slate-500">Tidak ada transaksi COMPLETED pada filter ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow dark:border-slate-700 dark:bg-slate-800">
            <h3 class="mb-4 text-lg font-bold text-[#0A2540] dark:text-white">Produk Terlaris</h3>
            <div class="space-y-3">
                @forelse($produkTerlaris as $index => $produk)
                    <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3 dark:bg-slate-700/50"><span><b class="mr-3 text-blue-600">{{ $index + 1 }}</b>{{ $produk['nama'] }}</span><span class="font-semibold">{{ $produk['jumlah'] }} pcs</span></div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada produk terjual.</p>
                @endforelse
            </div>
        </div>
        <div class="rounded-3xl border border-blue-100 bg-blue-50 p-6 dark:border-blue-900 dark:bg-blue-950/30">
            <h3 class="font-bold text-blue-800 dark:text-blue-300"><i class="fa-solid fa-circle-check mr-2"></i>Pemeriksaan Laporan</h3>
            <p class="mt-2 text-sm leading-6 text-blue-700 dark:text-blue-400">Hanya transaksi berstatus <b>COMPLETED</b> yang dihitung. Tampilan, PDF, dan Excel menggunakan satu sumber filter yang sama. Cocokkan kode referensi untuk memastikan hasil ekspor berasal dari data yang sama.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const jenis = document.getElementById('jenis-periode');
    const toggle = () => {
        const value = jenis.value;
        document.querySelector('[data-filter="tanggal"]').classList.toggle('hidden', value === 'bulanan' || value === 'rentang');
        document.querySelector('[data-filter="bulan"]').classList.toggle('hidden', value !== 'bulanan');
        document.querySelectorAll('[data-filter="rentang"]').forEach(el => el.classList.toggle('hidden', value !== 'rentang'));
    };
    jenis.addEventListener('change', toggle);
    toggle();
});
</script>
@endsection
