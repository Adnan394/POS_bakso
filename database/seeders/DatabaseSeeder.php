<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Payment;
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
        Role::create([
            'name' => 'Kasir',
        ]);

        Location::create([
            'locations' => 'Purwokerto',
        ]);

        Outlet::create([
            'name' => 'Dapur Minuman',
            'location_id' => '1',
        ]);

        Outlet::create([
            'name' => 'Dapur Makanan',
            'location_id' => '1',
        ]);

        User::create([
            'name' => 'Admin Pusat',
            'email' => 'superadmin@gmail.com',
            'role_id' => '1',
            'password' => Hash::make('superadmin'),
            'location_id' => '1',
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => '2',
            'password' => Hash::make('admin123'),
            'location_id' => '1',
        ]);
        User::create([
            'name' => 'Kasir Pusat',
            'email' => 'kasir1@gmail.com',
            'role_id' => '3',
            'password' => Hash::make('kasir123'),
            'location_id' => '1',
        ]);

        Payment::create([
            'name' => 'Cash',
        ]);
        Payment::create([
            'name' => 'QRIS',
        ]);
        Payment::create([
            'name' => 'Transfer Bank',
        ]);

    }
}
