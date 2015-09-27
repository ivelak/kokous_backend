<?php

use App\Event;
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
        $event = new Event();
        $event->name = 'Kokous';
        $event->time = '2016-07-25 16:40:00';
        $event->place = 'Kolo';
        $event->description = 'Iltakokous';
        
        $event->save();

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
