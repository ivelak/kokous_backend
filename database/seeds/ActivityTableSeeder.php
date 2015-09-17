<?php

use Illuminate\Database\Seeder;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 0; $i < 100; $i++)
        {
            DB::table('activities')->insert([
                'guid' => rand(0, 1000000),
                'name' => str_random(10)
            ]);
        }
    }
}
