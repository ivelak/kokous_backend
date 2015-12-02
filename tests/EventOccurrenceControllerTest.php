<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\EventOccurrenceController;
use App\EventOccurrence;
use App\User;

class EventOccurrenceControllerTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    
     private function logIn() {
        $user = new User();
        $user->membernumber = '23123342';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';
        
        $user->save();
        
        Auth::login($user);
    }

    public function setUp() {
        parent::setUp();
        $this->controller = new EventOccurrenceController();
    }

    public function testIndex() {
        $this->login();
        
        $this->action('GET', 'EventOccurrenceController@index');
        $this->seePageIs('/event-occurrences');
    }

    public function testEventOccurrencesCreatedWithCorrectRequirements() {
        $this->login();
        
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();

        $this->visit('/events/new')
                ->submitForm('Lisää tapahtuma', ['days' => ['1'], 'name' => 'Hippa',
                    'groupId' => '1', 'date' => '27.03.2016', 'repeat' => 'on',
                    'time' => '23:45', 'place' => 'Onkalo', 'ending' => 'afterYear',
                    'interval' => '1'])
                ->seePageIs('/events')
        ;
    }

    public function testEventOccurrencesNotCreatedWithWrongAtrributes() {
        $this->login();
        
        factory(App\Group::class, 5)->create();

        $this->visit('/events/new')
                ->submitForm('Lisää tapahtuma', ['days' => ['1'], 'name' => 'Hippa',
                    'groupId' => '1', 'date' => '27.03.2016', 'repeat' => 'on',
                    'time' => '23:45', 'place' => '', 'ending' => 'afterYear',
                    'interval' => '1'])
                ->seePageIs('/events/new')
                ->notSeeInDatabase('event_occurrences', ['time' => '23:45', 'place' => 'Onkalo',]);
    }

    public function testEventOccurrencesNotCreatedWithWrongAtrributes2() {
        $this->login();
        
        factory(App\Group::class, 5)->create();

        $this->visit('/events/new')
                ->submitForm('Lisää tapahtuma', ['days' => ['1'], 'name' => 'Hippa',
                    'groupId' => '1', 'date' => '', 'repeat' => 'on',
                    'time' => '23:45', 'place' => 'Onkalo', 'ending' => 'afterYear',
                    'interval' => '1'])
                ->seePageIs('/events/new')
                ->notSeeInDatabase('event_occurrences', ['time' => '23:45', 'place' => 'Onkalo',]);
    }

    public function testEventOccurrencesNotCreatedWithWrongAtrributes3() {
        $this->login();
        
        factory(App\Group::class, 5)->create();

        $this->visit('/events/new')
                ->submitForm('Lisää tapahtuma', ['days' => ['1'], 'name' => 'Hippa',
                    'groupId' => '1', 'date' => '27.03.2016', 'repeat' => 'on',
                    'time' => '', 'place' => 'Onkalo', 'ending' => 'afterYear',
                    'interval' => '1'])
                ->seePageIs('/events/new')
                ->notSeeInDatabase('event_occurrences', ['time' => '23:45', 'place' => 'Onkalo',]);
    }

    public function testEventOccurrencesNotCreatedWithWrongAtrributes4() {
        $this->login();
        
        factory(App\Group::class, 5)->create();

        $this->visit('/events/new')
                ->submitForm('Lisää tapahtuma', ['days' => ['1'], 'name' => 'Hippa',
                    'groupId' => '1', 'date' => '27.03.2016', 'repeat' => 'on',
                    'time' => '', 'place' => 'Onkalo', 'ending' => 'afterYear',
                    'interval' => '1'])
                ->seePageIs('/events/new')
                ->notSeeInDatabase('event_occurrences', ['time' => '23:45', 'place' => 'Onkalo',]);
    }

    public function testEventOccurrencesNotCreatedWithWrongAtrributes5() {
        $this->login();
        
        factory(App\Group::class, 5)->create();

        $this->visit('/events/new')
                ->submitForm('Lisää tapahtuma', ['days' => ['1'], 'name' => '',
                    'groupId' => '1', 'date' => '27.03.2016', 'repeat' => 'on',
                    'time' => '23:45', 'place' => 'Onkalo', 'ending' => 'afterYear',
                    'interval' => '1'])
                ->seePageIs('/events/new')
                ->notSeeInDatabase('event_occurrences', ['time' => '23:45', 'place' => 'Onkalo',]);
    }

}
