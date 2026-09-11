<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{
    /**
     * Determine if the user can view the dashboard.
     */
    public function viewAny(User $user)
    {
        return $user->role->name === 'Admin';
    }
}
