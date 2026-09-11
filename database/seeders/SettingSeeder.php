<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'nama_toko' => 'MitraMart',
                'alamat' => 'Tasikmalaya',
                'telepon' => '',
                'email' => '',
                'pengelola' => 'Aditya Dwi Saputra',
                'bahasa' => 'id',
                'mata_uang' => 'IDR',
                'per_page' => 10,
                'nama_aplikasi' => 'MitraMart POS',
                'versi_aplikasi' => '1.0.0',
                'deskripsi_aplikasi' => 'Sistem kasir digital untuk membantu pengelolaan produk dan transaksi MitraMart.',
                'developer' => 'Aditya Dwi Saputra',
            ]
        );
    }
}
