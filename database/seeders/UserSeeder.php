<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminPassword = 'admin12345';
        $kasirPassword = 'kasir12345';

        $adminRole = Role::where('name', 'Admin')->firstOrFail();
        $kasirRole = Role::where('name', 'Kasir')->firstOrFail();

        User::updateOrCreate(
            ['email' => 'admin@mitramart.com'],
            [
                'email' => 'admin@mitramart.com',
                'name' => 'ADITYA DWI SAPUTRA',
                'role_id' => $adminRole->id,
                'password' => Hash::make($adminPassword),
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir@mitramart.com'],
            [
                'email' => 'kasir@mitramart.com',
                'name' => 'ADIT',
                'role_id' => $kasirRole->id,
                'password' => Hash::make($kasirPassword),
            ]
        );
    }
}
