<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use LogsActivity;

    protected $fillable = [
    'nama_toko',
    'alamat',
    'telepon',
    'email',
    'logo',
    'pengelola',

    'bahasa',
    'mata_uang',
    'per_page',

    'nama_aplikasi',
    'versi_aplikasi',
    'deskripsi_aplikasi',
    'developer',
];
}
