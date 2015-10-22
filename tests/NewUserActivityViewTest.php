<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Activity;

class NewUserActivityViewTest extends TestCase {

    use DatabaseMigrations;
    
    public function testActivityIsAddedToUserCorrectly() {
        $user = new User();
        $user->username = 'Test_user';
        $user->partio_id = '000001';
        $user->membernumber = '100000';
        $user->postalcode = '00550';
        $user->is_scout = true;
        $user->email = 'test@test.com';
        $user->firstname = 'First_name';
        $user->lastname = 'Last_name';
        $user->save();
        
        $activity = new Activity();
        $activity->guid = 1;
        $activity->name = 'Activity 1';
        $activity->age_group = 'sudenpennut';
        $activity->save();
        
        
        $this->visit('/users/1/activities')
             ->select('1', 'activityId')
             ->press('Lisää')
             ->seeInDatabase('activity_user', ['activity_id'=>1,'user_id'=>1]);
    }

}
