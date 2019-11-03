<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create(['level' => 'Administrator']);
        Level::create(['level' => 'Waiter']);
        Level::create(['level' => 'Kasir']);
        Level::create(['level' => 'Owner']);
    }
}
