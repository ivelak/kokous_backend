<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\UserActivityController;
use App\Group;
use App\Event;
use App\EventOccurrence;
use App\Activity;

class EventOccurrenceViewTest extends TestCase
{   
    use DatabaseMigrations;
    
    public function setUp() 
    {
        parent::setUp();
    }
    
    private function initData()
    {
        factory(App\Activity::class, 50)->create();
        factory(App\User::class, 10)->create();
        factory(App\User::class, 'admin', 1)->create();
        factory(App\Group::class, 25)->create()->each(function($g) {
            for($i = 0; $i < 5; $i++)
            {
                $g->users()->save(factory(App\User::class)->make(), ['role' => 'member']);
            }
            $g->users()->save(factory(App\User::class)->make(), ['role' => 'leader']);
        });
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
    
    public function testMarkingActivitiesToUsers()
    {
        self::initData();
        $event = Event::find(1);
        $group = $event->group;
        $eventOccurrence = $event->eventOccurrences->first();
        
        $this->visit('/events/' . $event->id . '/occurrences/' . $eventOccurrence->id)
             ->check($group->users->first()->id)
             ->press('Merkitse suoritetuiksi')
             ->seePageIs('/events/' . $event->id . '/occurrences/' . $eventOccurrence->id)
             ->seeInDatabase('activity_user', ['activity_id' => $eventOccurrence->activities->first()->id, 'user_id' => $group->users->first()->id]);
    }
        
        public function testCorrectViewShows() {
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();

        $this->visit('/events/new')
                ->type('Hippa', 'name')
                ->type('23.07.2027', 'date')
                ->type('16:20', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Helsinki', 'place')
                ->type('Hauskaa', 'description')
                ->press('Lisää tapahtuma')
                
                ->visit('/events/1/occurrences/1')
                ->see('Hippa')
                ->see('Helsinki')
                ->see('23.07.2027')
                ->see('16:20')
                ->see('Hauskaa')
                ->see('Suoritusten merkitseminen:');
    }

    public function testLinkEditLeadsToCorrectPage() {
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();
        
        $this->visit('/events/new')
                ->type('Jumppa', 'name')
                ->type('23.07.2027', 'date')
                ->type('16:20', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Helsinki', 'place')
                ->type('Hauskaa', 'description')
                ->press('Lisää tapahtuma')
                
                ->visit('/events/1/occurrences/1')
                ->see('Jumppa')
                ->see('Helsinki')
                ->see('23.07.2027')
                ->see('16:20')
                ->see('Hauskaa')
                ->see('Suoritusten merkitseminen:');

        $this->visit('/events/1/occurrences/1')
             ->click('edit')
             ->seePageIs('/events/1/occurrences/1/edit');
    }
    public function testLinkMuutaAktiviteettejaLeadsToCorrectPage() {
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();
        
        $this->visit('/events/new')
                ->type('Jumppatuokio', 'name')
                ->type('23.07.2027', 'date')
                ->type('16:20', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Helsinki', 'place')
                ->type('Hauskaa', 'description')
                ->press('Lisää tapahtuma')
                
                ->visit('/events/1/occurrences/1')
                ->see('Jumppatuokio')
                ->see('Helsinki')
                ->see('23.07.2027')
                ->see('16:20')
                ->see('Hauskaa')
                ->see('Suoritusten merkitseminen:');

        $this->visit('/events/1/occurrences/1')
             ->click('Muuta aktiviteetteja')
             ->seePageIs('/events/1/occurrences/1/activities');
    }
   

}