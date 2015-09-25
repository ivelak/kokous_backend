<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $this->visit('/events/new')
             ->type('Hippa','name')
             ->type('23.07.2019','date')
             ->type('16:20','time')
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
        $this->visit('/events/new')
             ->type('Jumppa','name')
             ->type('22.01.2016','date')
             ->type('16:25','time')
             ->type('Helsinki','place')
             ->type('Hauskaa','description')
             ->press('Lisää tapahtuma')
             
          
             ->seePageIs('/events');
        
        $event_id = DB::table('events')->where('name', 'Jumppa')->value('id');
        
        /*
        
        $this->seePageIs('/events')
             ->click($event_id)
             ->seePageIs('/events/'.'$event_id')
             ->see('Kuvaus:')
             ->see('Hauskaa');
       */      
        $this->visit('/events/'. $event_id)
             ->see('Kuvaus:')
             ->see('Hauskaa');
       //Tulisi klikata taulukon riviä ja nähdä, että siirtyy oikealle sivulle.
    }
    
}
