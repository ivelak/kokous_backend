<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Seeder;
use App\User;

class EventsViewTest extends TestCase {

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    private function logIn() {
        $user = new User();
        $user->membernumber = '23123342';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';

        $user->save();

        Auth::login($user);
    }

    public function testCorrectViewWhenNothingAdded() {
        $this->logIn();
        
        $this->visit('/events')
                ->see('Ei tapahtumia');
    }

    public function testClickingOnLinkLeadsToCorrectView() {
        $this->logIn();
        
        $this->visit('/events')
                ->click('Uusi tapahtuma')
                ->seePageIs('/events/new');
    }

    public function testCorrectlyAddedEventShowsOnTheEventsList() {
        $this->logIn();
        
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();
        factory(App\Event::class, 5)->create();

        $this->visit('/events/new')
                ->type('Hippa', 'name')
                ->type('23.07.2019', 'date')
                ->type('16:20', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Helsinki', 'place')
                ->type('Hauskaa', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events')
                ->see('Hippa')
                ->see('Helsinki')
                ->see('23.07.2019')
                ->see('16:20');
    }

    public function testClickingOnEventLeadsToEventView() {
        $this->logIn();
        
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();
        factory(App\Event::class, 5)->create();

        $this->visit('/events/1')
                ->seePageIs('/events/1'); // Muuttakaa klikattavaksi jos osaatte
    }

}
