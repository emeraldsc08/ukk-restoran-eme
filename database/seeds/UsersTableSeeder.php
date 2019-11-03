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
            'nama' => 'Rakandhiya',
            'id_level' => 1
        ]);

        Users::create([
            'username' => 'waiter',
            'password' => Hash::make('waiter'),
            'nama' => 'Daanii',
            'id_level' => 2
        ]);

        Users::create([
            'username' => 'kasir',
            'password' => Hash::make('kasir'),
            'nama' => 'Rachmanto',
            'id_level' => 3
        ]);

        Users::create([
            'username' => 'owner',
            'password' => Hash::make('mataram03'),
            'nama' => 'Rakandhiya Daanii Rachmanto',
            'id_level' => 4
        ]);
    }
}
