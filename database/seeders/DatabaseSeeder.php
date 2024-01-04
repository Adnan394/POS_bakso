<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Payment;
use App\Models\Produk;
use App\Models\Table;
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
        Role::create([
            'name' => 'Outlet',
        ]);

        Location::create([
            'locations' => 'Purwokerto',
        ]);
        Location::create([
            'locations' => 'Purbalingga',
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
            'name' => 'Admin Purwokerto',
            'email' => 'adminpwt@gmail.com',
            'role_id' => '2',
            'password' => Hash::make('admin123'),
            'location_id' => '1',
        ]);
        User::create([
            'name' => 'Admin Purbalingga',
            'email' => 'adminpbg@gmail.com',
            'role_id' => '2',
            'password' => Hash::make('admin123'),
            'location_id' => '2',
        ]);
        User::create([
            'name' => 'Kasir Pusat',
            'email' => 'kasir1@gmail.com',
            'role_id' => '3',
            'password' => Hash::make('kasir123'),
            'location_id' => '1',
        ]);
        User::create([
            'name' => 'Outlet Pusat',
            'email' => 'outlet1@gmail.com',
            'role_id' => '4',
            'password' => Hash::make('outlet123'),
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

        Produk::create([
            'name' => 'Es Jeruk',
            'price' => 4000,
            'image' => 'gambar_stock/bakso.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => '1',
            'location_id' => '1',
        ]);
        Produk::create([
            'name' => 'Bakso',
            'price' => 10000,
            'image' => 'gambar_stock/Removal-244-removebg-preview.png',
            'status_stock' => 'Tersedia',
            'outlet_id' => '2',
            'location_id' => '1',
        ]);

        Table::create([
            'number' => 1,
        ]);
        Table::create([
            'number' => 2,
        ]);
        Table::create([
            'number' => 3,
        ]);
        Table::create([
            'number' => 4,
        ]);
        Table::create([
            'number' => 5,
        ]);

    }
}