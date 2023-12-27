<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::create([
            'name' => 'SuperAdmin',
        ]);
        Role::create([
            'name' => 'Admin',
        ]);

        Location::create([
            'locations' => 'Purwokerto',
        ]);

        User::create([
            'name' => 'Admin Pusat',
            'email' => 'superadmin@gmail.com',
            'role_id' => '1',
            'password' => Hash::make('superadmin'),
            'location_id' => '1',
        ]);

    }
}
