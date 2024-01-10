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
        Role::create([
            'name' => 'Waiters',
        ]);

        Location::create([
            'locations' => 'Purbalingga',
        ]);
        Location::create([
            'locations' => 'Purwokerto',
        ]);

        Outlet::create([
            'name' => 'Utama',
            'location_id' => '1',
        ]);

        Outlet::create([
            'name' => 'Tenant',
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
            'location_id' => '2',
        ]);
        User::create([
            'name' => 'Admin Purbalingga',
            'email' => 'adminpbg@gmail.com',
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
            'name' => 'Bakso Polos Isi 5',
            'price' => 10000,
            'image' => 'gambar_stock/bakso_polos_isi_5.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        Produk::create([
            'name' => 'Bakso Polos Isi 10',
            'price' => 14000,
            'image' => 'gambar_stock/bakso_polos_isi_10.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        Produk::create([
            'name' => 'Bakso Polos Isi 5 + Basreng',
            'price' => 14000,
            'image' => 'gambar_stock/bakso.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        Produk::create([
            'name' => 'Bakso Polos Isi 10 + Tetelan',
            'price' => 19000,
            'image' => 'gambar_stock/bakso_polos_isi_10_tetelan.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        // Bakso Urat 1
        Produk::create([
            'name' => 'Bakso Urat 1, Polos 5',
            'price' => 17000,
            'image' => 'gambar_stock/bakso_urat_1_polos_5.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        Produk::create([
            'name' => 'Bakso Urat 1, Polos 4 + Basreng',
            'price' => 17000,
            'image' => 'gambar_stock/bakso_urat_1_polos_basreng.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        Produk::create([
            'name' => 'Bakso Urat 1, Polos 5 + Tetelan',
            'price' => 22000,
            'image' => 'gambar_stock/bakso_urat_1_polos_5_tetelan.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        Produk::create([
            'name' => 'Bakso Daging 1, Polos 5',
            'price' => 17000,
            'image' => 'gambar_stock/bakso_urat_1_polos_5_tetelan.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);
        Produk::create([
            'name' => 'Bakso Daging 1, Polos 4 + Basreng',
            'price' => 17000,
            'image' => 'gambar_stock/bakso_urat_1_polos_5_tetelan.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);
        Produk::create([
            'name' => 'Bakso Daging 1, Polos 5 + Tetelan',
            'price' => 22000,
            'image' => 'gambar_stock/bakso_urat_1_polos_5_tetelan.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);
        Produk::create([
            'name' => 'Bakso Campur Urat 1, Daging 1 Polos 5',
            'price' => 22000,
            'image' => 'gambar_stock/bakso_urat_1_polos_5_tetelan.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);
        Produk::create([
            'name' => 'Bakso Daging 1, Urat 1, Polos 4',
            'price' => 22000,
            'image' => 'gambar_stock/bakso_urat_1_polos_5_tetelan.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);
        Produk::create([
            'name' => 'Bakso Daging 1, Urat 1, Polos 5 + Tetelan',
            'price' => 27000,
            'image' => 'gambar_stock/bakso_urat_1_polos_5_tetelan.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);


        // Juice Nanas
        Produk::create([
            'name' => 'Juice Nanas',
            'price' => 7000,
            'image' => 'gambar_stock/juice_nanas.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);


        // Es Jeruk
        Produk::create([
            'name' => 'Es Jeruk',
            'price' => 10000,
            'image' => 'gambar_stock/es_jeruk.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        Produk::create([
            'name' => 'Es Teh Manis',
            'price' => 10000,
            'image' => 'gambar_stock/es_teh_manis.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        // Es Jeruk
        Produk::create([
            'name' => 'Es Jeruk',
            'price' => 10000,
            'image' => 'gambar_stock/es_jeruk.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        // Es Kopi/Koptil
        Produk::create([
            'name' => 'Es Kopi/Koptil',
            'price' => 10000,
            'image' => 'gambar_stock/es_kopi_koptil.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        // Es Milo Dalgona
        Produk::create([
            'name' => 'Es Milo Dalgona',
            'price' => 10000,
            'image' => 'gambar_stock/es_milo_dalgona.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        // Chocolatos
        Produk::create([
            'name' => 'Chocolatos',
            'price' => 10000,
            'image' => 'gambar_stock/chocolatos.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        // Telur
        Produk::create([
            'name' => 'Telur',
            'price' => 3000,
            'image' => 'gambar_stock/telur.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        // Sosis
        Produk::create([
            'name' => 'Sosis',
            'price' => 3000,
            'image' => 'gambar_stock/sosis.jpg',
            'status_stock' => 'Tersedia',
            'outlet_id' => 1,
            'location_id' => 1,
        ]);

        // Table::create([
        //     'number' => 1,
        // ]);
        // Table::create([
        //     'number' => 2,
        // ]);
        // Table::create([
        //     'number' => 3,
        // ]);
        // Table::create([
        //     'number' => 4,
        // ]);
        // Table::create([
        //     'number' => 5,
        // ]);
    }
}