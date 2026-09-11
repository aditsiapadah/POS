<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemPenjualan;

class Penjualan extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'penjualan'; // Sesuaikan jika nama tabel Anda berbeda

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'payment_expired_at' => 'datetime',
            'paid_at' => 'datetime',
            'gateway_payload' => 'array',
        ];
    }

    // Relasi ke User (Kasir)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Item Penjualan
    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }
    public function items()
{
    return $this->hasMany(
        ItemPenjualan::class
    );
}
}
