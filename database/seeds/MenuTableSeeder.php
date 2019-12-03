<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'nama' => 'Lontang Balap',
            'harga' => '18000',
            'id_jenis_menu' => 1,
            'status' => 'Tersedia'
        ]);

        Menu::create([
            'nama' => 'Ayam Panggang Saus Manis',
            'harga' => '45000',
            'id_jenis_menu' => 1,
            'status' => 'Tersedia'
        ]);

        Menu::create([
            'nama' => 'Rawon Buntut',
            'harga' => '35000',
            'id_jenis_menu' => 1,
            'status' => 'Tersedia'
        ]);

        Menu::create([
            'nama' => 'Gurame Bakar Saus Aceh',
            'harga' => '45000',
            'id_jenis_menu' => 1,
            'status' => 'Tersedia'
        ]);

        Menu::create([
            'nama' => 'Mojito',
            'harga' => '7000',
            'id_jenis_menu' => 2,
            'status' => 'Tersedia'
        ]);

        Menu::create([
            'nama' => 'Soda Gembira',
            'harga' => '11000',
            'id_jenis_menu' => 2,
            'status' => 'Tersedia'
        ]);

        Menu::create([
            'nama' => 'Wedang Jahe',
            'harga' => '12000',
            'id_jenis_menu' => 3,
            'status' => 'Tersedia'
        ]);

        Menu::create([
            'nama' => 'Tahu Petis',
            'harga' => '10000',
            'id_jenis_menu' => 3,
            'status' => 'Tersedia'
        ]);
    }
}
