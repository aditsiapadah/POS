<?php

namespace Database\Seeders;

use App\Models\JenisProduk;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::where('email', 'admin@mitramart.com')->value('id');
        $jenisIds = JenisProduk::pluck('id', 'nama');

        $produk = [
            ['Indomie Goreng', 'Makanan', 2500, 3500, 100],
            ['Indomie Soto', 'Makanan', 2500, 3500, 85],
            ['Beras Premium 5kg', 'Makanan', 65000, 75000, 30],
            ['Minyak Goreng 1 Liter', 'Makanan', 16000, 20000, 45],
            ['Gula Pasir 1kg', 'Makanan', 14000, 17000, 40],
            ['Sari Roti Coklat', 'Makanan', 6000, 9000, 25],
            ['Aqua Botol 600ml', 'Minuman', 2500, 4000, 120],
            ['Teh Botol Sosro', 'Minuman', 3000, 5000, 80],
            ['Teh Pucuk Harum', 'Minuman', 3000, 5000, 75],
            ['Pocari Sweat 500ml', 'Minuman', 5000, 8000, 50],
            ['Kopi Kapal Api', 'Minuman', 1500, 3000, 90],
            ['Susu Ultra Milk', 'Minuman', 5000, 8000, 60],
            ['Lampu LED 12 Watt', 'Elektronik', 18000, 25000, 24],
            ['Kabel Data USB Type C', 'Elektronik', 15000, 25000, 35],
            ['Charger 18W', 'Elektronik', 45000, 65000, 20],
            ['Mouse Wireless', 'Elektronik', 60000, 85000, 15],
            ['Headset Bluetooth', 'Elektronik', 75000, 100000, 18],
            ['Powerbank 10000mAh', 'Elektronik', 90000, 120000, 12],
        ];

        foreach ($produk as $index => [$nama, $jenis, $hargaBeli, $hargaJual, $stok]) {
            Produk::updateOrCreate(
                ['nama' => $nama],
                [
                    'user_id' => $adminId,
                    'jenis_produk_id' => $jenisIds[$jenis],
                    'foto' => '',
                    'harga_beli' => $hargaBeli,
                    'harga_jual' => $hargaJual,
                    'stok' => $stok,
                ]
            );
        }
    }
}
