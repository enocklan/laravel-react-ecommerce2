<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // You can change this default
        ])->assignRole(RolesEnum::User->value);

        User::factory()->create([
            'name' => 'Vendor',
            'email' => 'vendor@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ])->assignRole(RolesEnum::Vendor->value);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ])->assignRole(RolesEnum::Admin->value);
    }
}
