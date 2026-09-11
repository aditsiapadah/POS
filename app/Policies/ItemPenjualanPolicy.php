<?php

namespace App\Policies;

use App\Models\ItemPenjualan;
use App\Models\User;

class ItemPenjualanPolicy
{
    public function delete(User $user, ItemPenjualan $penjualan): bool
    {
        return in_array(strtolower((string) $user->role->name), ['admin', 'kasir'], true)
            && $penjualan->penjualan->status === 'OPEN';
    }
}
