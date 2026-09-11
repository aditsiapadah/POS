<?php

namespace App\Policies;

use App\Models\Penjualan;
use App\Models\User;

class PenjualPolicy
{
    public function delete(User $user, Penjualan $penjualan): bool
    {
        // Hanya cek hak akses user
        return strtolower($user->role->name) === 'admin';
    }

    public function view(User $user, Penjualan $penjualan): bool
    {
        return strtolower($user->role->name) === 'admin';
    }
}
