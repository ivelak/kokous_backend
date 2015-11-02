<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\EventOccurrenceController;
use App\EventOccurrence;

class EventOccurrenceControllerTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();
        $this->controller = new EventOccurrenceController();
    }

    public function testIndex() {
        $this->action('GET', 'EventOccurrenceController@index');
        $this->seePageIs('/event-occurrences');
    }

    public function testEventOccurrencesCreatedWithCorrectRequirements() {
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
