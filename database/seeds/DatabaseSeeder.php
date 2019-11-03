<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(LevelTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(JenisMenuTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(MejaTableSeeder::class);
        Model::reguard();
    }
}
