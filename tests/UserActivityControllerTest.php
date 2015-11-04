<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\UserActivityController;
use App\Group;
use App\Activity;

class UserActivityControllerTest extends TestCase
{   
    use DatabaseMigrations;
    
    public function setUp() 
    {
        parent::setUp();
        $this->controller = new UserActivityController();
    }
    
    public function testManyActivitiesCanBeAddedToUsers()
    {
        factory(App\Group::class, 4)->create()->each(function($g) {
            for($i = 0; $i < 5; $i++)
            {
                $g->users()->save(factory(App\User::class)->make(), ['role' => 'member']);
            }
            $g->users()->save(factory(App\User::class)->make(), ['role' => 'leader']);
        });
        factory(App\Activity::class, 5)->create();
        
        $group = Group::find(1);
        $activity = Activity::find(1);
        
        
        $stuff = array(
            'activityId' => $activity->id,
            'group' => $group->id
        );
        
        foreach($group->users as $user)
        {
            $stuff[$user->id] = 'true';
        }
        
        
        $request = Request::create('/', 'POST', $stuff);
        $this->controller->addMany($request);
        
        foreach($group->users as $user)
        {
            $this->seeInDatabase('activity_user', ['activity_id' => $activity->id, 'user_id' => $user->id]);
        }
    }
   
}
