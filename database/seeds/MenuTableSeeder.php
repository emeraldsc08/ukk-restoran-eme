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
            'nama' => 'Ayam Goreng',
            'harga' => '22000',
            'id_jenis_menu' => 1
        ]);

        Menu::create([
            'nama' => 'Bebek Goreng',
            'harga' => '30000',
            'id_jenis_menu' => 1
        ]);

        Menu::create([
            'nama' => 'Rawon',
            'harga' => '25000',
            'id_jenis_menu' => 1
        ]);

        Menu::create([
            'nama' => 'Soto',
            'harga' => '25000',
            'id_jenis_menu' => 1
        ]);

        Menu::create([
            'nama' => 'Es Teh',
            'harga' => '3500',
            'id_jenis_menu' => 2
        ]);

        Menu::create([
            'nama' => 'Susu Coklat',
            'harga' => '3500',
            'id_jenis_menu' => 2
        ]);
        
        Menu::create([
            'nama' => 'Es Krim',
            'harga' => '8000',
            'id_jenis_menu' => 3
        ]);

        Menu::create([
            'nama' => 'Roti Bakar Keju',
            'harga' => '12000',
            'id_jenis_menu' => 3
        ]);
    }
}
