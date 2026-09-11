<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'jenis_produk_id',
        'nama',
        'foto',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisProduk()
    {
        return $this->belongsTo(JenisProduk::class);
    }
}
