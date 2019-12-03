<?php

use Illuminate\Database\Seeder;
use App\Users;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'nama' => 'Emerald',
            'id_level' => 1
        ]);

        Users::create([
            'username' => 'waiter',
            'password' => Hash::make('waiter'),
            'nama' => 'Parkiyem',
            'id_level' => 2
        ]);

        Users::create([
            'username' => 'kasir',
            'password' => Hash::make('kasir'),
            'nama' => 'Jubaedah',
            'id_level' => 3
        ]);

        Users::create([
            'username' => 'owner',
            'password' => Hash::make('mataram03'),
            'nama' => 'Emerald Shan Cakrawala',
            'id_level' => 4
        ]);
    }
}
