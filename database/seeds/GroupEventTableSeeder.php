<?php

use Illuminate\Database\Seeder;
use App\Group;
use App\Event;

class GroupEventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        /*$groups = Group::all();
        $events = Event::all()->toArray();

        foreach ($groups as $group) {

            foreach($faker->randomElements($events,$faker->randomDigit) as $event){
                $group->events()->attach($event['id']);
            }
        }*/
        
        $groups = Group::all()->toArray();
        $events = Event::all();
        
        foreach($events as $event)
        {
            foreach($faker->randomElements($groups, $faker-randomDigit) as $group)
            {
                $event->group = $group;
            }
        }
    }
}
