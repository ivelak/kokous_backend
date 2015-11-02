<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventOccurrenceViewTest extends TestCase {

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
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
