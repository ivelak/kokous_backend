<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Activity;

class NewUserActivityViewTest extends TestCase {

    use DatabaseMigrations;
    
    private function logIn() {
        $user = new User();
        $user->membernumber = '23123342';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';

        $user->save();

        Auth::login($user);
    }
    
    
    public function testActivityIsAddedToUserCorrectly() {
        $this->logIn();
        
        $user = new User();
        $user->membernumber = '100000';
        $user->firstname = 'First_name';
        $user->lastname = 'Last_name';
        $user->save();
        
        $activity = new Activity();
        $activity->guid = 1;
        $activity->name = 'Activity 1';
        $activity->age_group = 'sudenpennut';
        $activity->task_group = 'pohjoinen';
        $activity->save();
        
        
        $this->visit('/users/1/activities')
             ->select('1', 'activityId')
             ->press('Lisää')
             ->seeInDatabase('activity_user', ['activity_id'=>1,'user_id'=>1]);
    }

}
