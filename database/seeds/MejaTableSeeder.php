<?php

use Illuminate\Database\Seeder;
use App\Meja;

class MejaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meja::create(['nomer' => 1]);
        Meja::create(['nomer' => 2]);
        Meja::create(['nomer' => 3]);
        Meja::create(['nomer' => 4]);
        Meja::create(['nomer' => 5]);
        Meja::create(['nomer' => 6]);
        Meja::create(['nomer' => 7]);
        Meja::create(['nomer' => 8]);
        Meja::create(['nomer' => 9]);
        Meja::create(['nomer' => 10]);
    }
}
