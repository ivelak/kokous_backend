<?php

use App\Event;
use App\Activity;
use App\Group;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\DevLoginController;

class ActivityViewTest extends TestCase {

    use DatabaseMigrations;

    private function logIn() {
        $user = new User();
        $user->membernumber = '23123342';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';
        
        $user->save();
        
        Auth::login($user);
    }

    public function testCorrectViewWhenNoActivitiesAdded() {
        $this->logIn();
        $this->visit('/activities')
                ->see('Ei aktiviteetteja');
    }

    public function testActivitiesRetrievedFromPOF() {
        $this->logIn();
        session()->set('admin',1);
        $this->expectsJobs(App\Jobs\SynchronizeWithPOF::class);
        $this->visit('/activities')
                ->seePageIs('/activities')
                ->press('Hae POFista');
    }

    private static function createTestGroup() {
        $group = new Group();
        $group->name = 'Test123';
        $group->scout_group = 'Test_group123';
        $group->age_group = 'sudenpennut';
        $group_id = $group->save();
        return $group_id;
    }

    public function testActivityCanBeAddedToAnEvent1() {
        $this->logIn();
        
        $event = new Event();
        $event->name = 'Kokous';
        $event->time = '2016-07-25 16:40:00';
        $event->place = 'Kolo';
        $event->description = 'Iltakokous';
        $event->endDate = '2016-07-25 17:20:20';
        $event->group_id = self::createTestGroup();
        $event->save();


        $activity = new Activity();
        $activity->name = 'Kalastus';
        $activity->guid = 'Guid';
        $activity->age_group = 'sudenpennut';
        $activity->task_group = 'pohjoinen';
        $activity->save();

        $event_id = DB::table('events')->where('name', 'Kokous')->value('id');

        // Pitää muutta occurensejä käyttämään
        /* $this->visit('/events/'. $event_id)
          ->click('Muuta aktiviteetteja')
          ->see('Äänestys')
          ->press('Lisää')
          ->click('Takaisin')
          ->see('Äänestys'); */
    }

}
