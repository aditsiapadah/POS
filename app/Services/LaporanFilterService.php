<?php

namespace App\Services;

use App\Models\Penjualan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class LaporanFilterService
{
    public function build(User $user, array $filters): array
    {
        [$tanggalAwal, $tanggalAkhir, $periode] = $this->resolvePeriod($filters);

        $penjualan = $this->query($user, $filters, $tanggalAwal, $tanggalAkhir)
            ->latest()
            ->get();

        $totalTransaksi = $penjualan->count();
        $totalPendapatan = (int) $penjualan->sum('total_pembayaran');
        $totalProdukTerjual = (int) $penjualan->sum(
            fn (Penjualan $transaksi) => $transaksi->itemPenjualan->sum('kuantitas')
        );

        $pembayaran = collect(['CASH', 'TRANSFER', 'QRIS'])->mapWithKeys(
            fn (string $metode) => [
                $metode => [
                    'jumlah' => $penjualan->where('metode_pembayaran', $metode)->count(),
                    'total' => (int) $penjualan->where('metode_pembayaran', $metode)->sum('total_pembayaran'),
                ],
            ]
        );

        $produkTerlaris = $this->produkTerlaris($penjualan);
        $generatedAt = now();
        $verificationCode = strtoupper(substr(hash('sha256', json_encode([
            'ids' => $penjualan->pluck('id')->values()->all(),
            'total' => $totalPendapatan,
            'filters' => $filters,
        ])), 0, 12));

        return compact(
            'filters',
            'tanggalAwal',
            'tanggalAkhir',
            'periode',
            'penjualan',
            'totalTransaksi',
            'totalPendapatan',
            'totalProdukTerjual',
            'pembayaran',
            'produkTerlaris',
            'generatedAt',
            'verificationCode',
        );
    }

    private function query(User $user, array $filters, Carbon $tanggalAwal, Carbon $tanggalAkhir): Builder
    {
        return Penjualan::query()
            ->with(['user', 'itemPenjualan.produk'])
            ->where('status', 'COMPLETED')
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->when(
                $filters['kasir_id'] ?? null,
                fn (Builder $query, $kasirId) => $query->where('user_id', $kasirId)
            )
            ->when(
                $filters['metode_pembayaran'] ?? null,
                fn (Builder $query, $metode) => $query->where('metode_pembayaran', $metode)
            )
            ->when($filters['search'] ?? null, function (Builder $query, string $search) {
                $query->where(function (Builder $q) use ($search) {
                    $q->where('id', $search)
                        ->orWhereHas('user', fn (Builder $userQuery) => $userQuery
                            ->where('name', 'like', '%' . $search . '%'));
                });
            });
    }

    private function resolvePeriod(array $filters): array
    {
        $jenis = $filters['jenis'];

        if ($jenis === 'rentang') {
            $awal = Carbon::parse($filters['tanggal_awal'])->startOfDay();
            $akhir = Carbon::parse($filters['tanggal_akhir'])->endOfDay();
        } elseif ($jenis === 'mingguan') {
            $tanggal = Carbon::parse($filters['tanggal']);
            $awal = $tanggal->copy()->startOfWeek(Carbon::MONDAY)->startOfDay();
            $akhir = $tanggal->copy()->endOfWeek(Carbon::SUNDAY)->endOfDay();
        } elseif ($jenis === 'bulanan') {
            $bulan = Carbon::createFromFormat('Y-m', $filters['bulan']);
            $awal = $bulan->copy()->startOfMonth()->startOfDay();
            $akhir = $bulan->copy()->endOfMonth()->endOfDay();
        } else {
            $tanggal = Carbon::parse($filters['tanggal']);
            $awal = $tanggal->copy()->startOfDay();
            $akhir = $tanggal->copy()->endOfDay();
        }

        $periode = $awal->isSameDay($akhir)
            ? $awal->translatedFormat('d F Y')
            : $awal->translatedFormat('d F Y') . ' - ' . $akhir->translatedFormat('d F Y');

        return [$awal, $akhir, $periode];
    }

    private function produkTerlaris(Collection $penjualan): Collection
    {
        return $penjualan
            ->flatMap->itemPenjualan
            ->filter(fn ($item) => $item->produk)
            ->groupBy('produk_id')
            ->map(fn (Collection $items) => [
                'nama' => $items->first()->produk->nama,
                'jumlah' => (int) $items->sum('kuantitas'),
            ])
            ->sortByDesc('jumlah')
            ->take(5)
            ->values();
    }
}
