<?php

use App\Event;
use App\Activity;
use App\Group;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ActivityViewTest extends TestCase {

    use DatabaseMigrations;


    public function testCorrectViewWhenNoActivitiesAdded() {
        $this->visit('/activities')
             ->see('Ei aktiviteetteja');
    }
    
    public function testActivitiesRetrievedFromPOF() {
        $this->visit('/activities')
             ->press('Hae POFista')
             ->dontSee('Ei aktiviteetteja');
    }
    
    private static function createTestGroup(){
        $group = new Group();
        $group->name = 'Test123';
        $group->scout_group = 'Test_group123';
        $group->age_group = 'sudenpennut';
        $group_id = $group->save();
        return $group_id;
    }

    public function testActivityCanBeAddedToAnEvent() {
        $event = new Event();
        $event->name = 'Kokous';
        $event->time = '2016-07-25 16:40:00';
        $event->place = 'Kolo';
        $event->description = 'Iltakokous';
        $event->endDate = '2016-07-25 17:20:20';
        $event->group_id = self::createTestGroup();
        $event->save();

        $activity = new Activity();
        $activity->name = 'Äänestys';
        $activity->guid = 'Guid';
        $activity->age_group = 'sudenpennut';
        $activity->save();

        $event_id = DB::table('events')->where('name', 'Kokous')->value('id');

        // Pitää muutta occurensejä käyttämään
        /*$this->visit('/events/'. $event_id)
        ->click('Muuta aktiviteetteja')
        ->see('Äänestys')
        ->press('Lisää')
        ->click('Takaisin')
        ->see('Äänestys');*/
    }

}
