<?php

use App\Activity;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActivityViewTest extends TestCase {

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCorrectlyCreatedActivitySeenOnView() {
        $activity = new Activity();
        $activity->name = 'Juoksu';
        $activity->guid = 'Guid';

        $activity->save();

        $this->seeInDatabase('activities', ['name' => 'Juoksu'])
                ->visit('/activities')
                ->see('Juoksu');
    }

    public function testActivityCanBeAddedToAnEvent() {
        $this->visit('/events/new')
                ->type('Kokous', 'name')
                ->type('25.07.2016', 'date')
                ->type('16:40', 'time')
                ->type('Munkkiniemi', 'place')
                ->type('Melontaretki', 'description')
                ->press('Lisää tapahtuma');

        $activity = new Activity();
        $activity->name = 'Äänestys';
        $activity->guid = 'Guid';

        $activity->save();

        $event_id = DB::table('events')->where('name', 'Kokous')->value('id');

        $this->visit('/events/'. $event_id)
        ->click('Muuta aktiviteetteja')
        ->see('Äänestys')
        ->press('Lisää')
        ->click('Takaisin')
        ->see('Äänestys');
    }

}
