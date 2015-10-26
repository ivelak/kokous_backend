<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Seeder;

class EventsViewTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCorrectViewWhenNothingAdded()
    {
        $this->visit('/events')
             ->see('Ei tapahtumia');
    }
    public function testClickingOnLinkLeadsToCorrectView(){
        $this->visit('/events')
             ->click('Uusi tapahtuma')
             
             ->seePageIs('/events/new');
    }
    
    public function testCorrectlyAddedEventShowsOnTheEventsList(){
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();
        factory(App\Event::class, 5)->create();
        
        $this->visit('/events/new')
             ->type('Hippa','name')
             ->type('23.07.2019','date')
             ->type('16:20','time')
             ->select('1', 'groupId')
             ->uncheck('repeat')
             ->type('Helsinki','place')
             ->type('Hauskaa','description')
             ->press('Lisää tapahtuma')
                
             ->seePageIs('/events')
             ->see('Hippa')
             ->see('Helsinki')
             ->see('23.07.2019')
             ->see('16:20');
        
        
    }
    
    public function testClickingOnEventLeadsToEventView(){
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();
        factory(App\Event::class, 5)->create();

        $this->visit('/events/1')
             ->seePageIs('/events/1'); // Muuttakaa klikattavaksi jos osaatte
    }
    
}
