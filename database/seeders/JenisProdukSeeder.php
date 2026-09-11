<?php

namespace Database\Seeders;

use App\Models\JenisProduk;
use Illuminate\Database\Seeder;

class JenisProdukSeeder extends Seeder
{
    public function run(): void
    {
        $jenisProduks = ['Makanan', 'Minuman', 'Elektronik'];

        foreach ($jenisProduks as $nama) {
            JenisProduk::firstOrCreate(['nama' => $nama]);
        }
    }
}
