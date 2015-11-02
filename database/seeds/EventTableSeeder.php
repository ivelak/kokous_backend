<?php

use App\Activity;
use App\EventOccurrence;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Event::class, 5)->create()->each(function ($event){
            $date = $event->time->startOfDay();
            $endDate = $event->endDate;
            do {
                $occurrence = new EventOccurrence();
                $occurrence->event_id = $event->id;
                $occurrence->date = $date;
                $occurrence->save();
            $date->addWeek();
        } while ($date < $endDate);
        });
        
        $faker = Faker\Factory::create();
        
        $occurrences = EventOccurrence::all();
        $activities = Activity::all()->toArray();
        
        foreach ($occurrences as $occurrence) {

            foreach($faker->randomElements($activities,$faker->randomDigit) as $activity){
                $occurrence->activities()->attach($activity['id']);
            }
        }
    }
}
