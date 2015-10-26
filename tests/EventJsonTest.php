<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Activity;
use App\Event;
use App\Group;

class EventJsonTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    
    public function test123() {
        
    }
    
    // JSON Tulee laittamaa toimimaan occurenceilla
    /*
    public function testEventJsonIsValid1(){
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();
        factory(App\Event::class, 5)->create();
        
        $this->visit('/events/new')
                ->type('Kokous', 'name')
                ->type('25.07.2016', 'date')
                ->type('16:40', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Munkkiniemi', 'place')
                ->type('Melontaretki', 'description')
                ->press('Lisää tapahtuma');

        $event_id = DB::table('events')->where('name', 'Kokous')->value('id');

        $this->get('/api/dev/events/'. $event_id)
    ->seeJson(['name'=>'Kokous','place'=>'Munkkiniemi','time_string'=>'16:40:00','date_string'=>'2016-07-25','description'=>'Melontaretki']);
        
    }
    
     public function testEventJsonIsValid2(){
         
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();
        factory(App\Event::class, 5)->create();
         
        $this->visit('/events/new')
                ->type('Iltakokous', 'name')
                ->type('26.08.2017', 'date')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('12:45', 'time')
                ->type('Haaga', 'place')
                ->type('siivouskokous', 'description')
                ->press('Lisää tapahtuma');

        $event_id = DB::table('events')->where('name', 'Kokous')->value('id');

        $this->get('/api/dev/events/'. $event_id)
    ->seeJson(['name'=>'Iltakokous','time_string'=>'12:45:00','date_string'=>'2017-08-26','place'=>'Haaga','description'=>'siivouskokous']);
        
    }*/
}
