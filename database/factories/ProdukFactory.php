<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\User;
use App\Models\Role;
use App\Models\JenisProduk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;

    public function definition(): array
    {
        $produkIndonesia = [

            // ================= MAKANAN =================
            [
                'nama' => 'Indomie Goreng',
                'jenis_produk' => 'Makanan',
                'harga_beli' => 2500,
                'harga_jual' => 3500,
            ],
            [
                'nama' => 'Indomie Soto',
                'jenis_produk' => 'Makanan',
                'harga_beli' => 2500,
                'harga_jual' => 3500,
            ],
            [
                'nama' => 'Beras Premium 5kg',
                'jenis_produk' => 'Makanan',
                'harga_beli' => 65000,
                'harga_jual' => 75000,
            ],
            [
                'nama' => 'Minyak Goreng Bimoli 1 Liter',
                'jenis_produk' => 'Makanan',
                'harga_beli' => 16000,
                'harga_jual' => 20000,
            ],
            [
                'nama' => 'Gula Pasir Gulaku 1kg',
                'jenis_produk' => 'Makanan',
                'harga_beli' => 14000,
                'harga_jual' => 17000,
            ],
            [
                'nama' => 'Sari Roti Coklat',
                'jenis_produk' => 'Makanan',
                'harga_beli' => 6000,
                'harga_jual' => 9000,
            ],
            [
                'nama' => 'Chitato Sapi Panggang',
                'jenis_produk' => 'Makanan',
                'harga_beli' => 8000,
                'harga_jual' => 12000,
            ],
            [
                'nama' => 'Roma Kelapa',
                'jenis_produk' => 'Makanan',
                'harga_beli' => 5000,
                'harga_jual' => 7000,
            ],


            // ================= MINUMAN =================
            [
                'nama' => 'Aqua Botol 600ml',
                'jenis_produk' => 'Minuman',
                'harga_beli' => 2500,
                'harga_jual' => 4000,
            ],
            [
                'nama' => 'Teh Botol Sosro',
                'jenis_produk' => 'Minuman',
                'harga_beli' => 3000,
                'harga_jual' => 5000,
            ],
            [
                'nama' => 'Teh Pucuk Harum',
                'jenis_produk' => 'Minuman',
                'harga_beli' => 3000,
                'harga_jual' => 5000,
            ],
            [
                'nama' => 'Pocari Sweat 500ml',
                'jenis_produk' => 'Minuman',
                'harga_beli' => 5000,
                'harga_jual' => 8000,
            ],
            [
                'nama' => 'Kopi Kapal Api',
                'jenis_produk' => 'Minuman',
                'harga_beli' => 1500,
                'harga_jual' => 3000,
            ],
            [
                'nama' => 'Susu Ultra Milk',
                'jenis_produk' => 'Minuman',
                'harga_beli' => 5000,
                'harga_jual' => 8000,
            ],


            // ================= ELEKTRONIK =================
            [
                'nama' => 'Lampu LED Philips 12 Watt',
                'jenis_produk' => 'Elektronik',
                'harga_beli' => 18000,
                'harga_jual' => 25000,
            ],
            [
                'nama' => 'Kabel Data USB Type C',
                'jenis_produk' => 'Elektronik',
                'harga_beli' => 15000,
                'harga_jual' => 25000,
            ],
            [
                'nama' => 'Charger Xiaomi 18W',
                'jenis_produk' => 'Elektronik',
                'harga_beli' => 45000,
                'harga_jual' => 65000,
            ],
            [
                'nama' => 'Mouse Wireless Logitech',
                'jenis_produk' => 'Elektronik',
                'harga_beli' => 60000,
                'harga_jual' => 85000,
            ],
            [
                'nama' => 'Headset Bluetooth Robot',
                'jenis_produk' => 'Elektronik',
                'harga_beli' => 75000,
                'harga_jual' => 100000,
            ],
            [
                'nama' => 'Powerbank 10000mAh',
                'jenis_produk' => 'Elektronik',
                'harga_beli' => 90000,
                'harga_jual' => 120000,
            ],
            [
                'nama' => 'Flashdisk Sandisk 32GB',
                'jenis_produk' => 'Elektronik',
                'harga_beli' => 50000,
                'harga_jual' => 70000,
            ],
        ];


        $produk = fake()->randomElement($produkIndonesia);


        // Ambil user Admin
        $adminRoleId = Role::where('name', 'Admin')->value('id');


        return [
            'user_id' => User::where('role_id', $adminRoleId)
                ->inRandomOrder()
                ->value('id'),


            'foto' => 'produk/' . fake()->uuid . '.jpg',

            'nama' => $produk['nama'],

            'jenis_produk_id' => JenisProduk::where('nama', $produk['jenis_produk'])->value('id'),

            'harga_beli' => $produk['harga_beli'],

            'harga_jual' => $produk['harga_jual'],

            'stok' => fake()->numberBetween(5, 200),
        ];
    }
}
