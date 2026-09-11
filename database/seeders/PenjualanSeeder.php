<?php

namespace Database\Seeders;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::with('role')
            ->whereIn('email', ['admin@mitramart.com', 'kasir@mitramart.com'])
            ->get();
        $produk = Produk::orderBy('id')->take(12)->get();

        if ($produk->count() < 3) {
            return;
        }

        foreach ($users as $user) {
            // Jangan menggandakan transaksi ketika db:seed dijalankan ulang.
            if ($user->penjualan()->whereHas('itemPenjualan')->exists()) {
                continue;
            }

            DB::transaction(function () use ($user, $produk): void {
                foreach (range(0, 4) as $nomor) {
                    $status = $nomor === 4 ? 'OPEN' : 'COMPLETED';
                    $metode = ['CASH', 'TRANSFER', 'QRIS'][$nomor % 3];
                    $waktu = now()->subDays(4 - $nomor)->setTime(9 + $nomor, 15);

                    $penjualan = Penjualan::create([
                        'user_id' => $user->id,
                        'total_pembayaran' => 0,
                        'metode_pembayaran' => $metode,
                        'status' => $status,
                        'payment_status' => $status === 'COMPLETED' ? 'PAID' : 'UNPAID',
                        'paid_at' => $status === 'COMPLETED' ? $waktu : null,
                        'created_at' => $waktu,
                        'updated_at' => $waktu,
                    ]);

                    $total = 0;
                    foreach ([$nomor, $nomor + 3] as $produkIndex) {
                        $itemProduk = $produk[$produkIndex % $produk->count()];
                        $kuantitas = ($produkIndex % 3) + 1;
                        $subtotal = $itemProduk->harga_jual * $kuantitas;

                        $penjualan->itemPenjualan()->create([
                            'produk_id' => $itemProduk->id,
                            'kuantitas' => $kuantitas,
                            'harga_satuan' => $itemProduk->harga_jual,
                            'subtotal' => $subtotal,
                        ]);
                        $total += $subtotal;
                    }

                    $penjualan->update([
                        'total_pembayaran' => $total,
                        'uang_dibayar' => $metode === 'CASH' ? $total : $total,
                        'kembalian' => 0,
                    ]);
                }
            });
        }
    }
}
