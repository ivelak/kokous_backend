<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\UserActivityController;
use App\Group;

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
        factory(App\Group::class, 10)->create()->each(function($g) {
            for($i = 0; $i < 5; $i++)
            {
                $g->users()->save(factory(App\User::class)->make(), ['role' => 'member']);
            }
            $g->users()->save(factory(App\User::class)->make(), ['role' => 'leader']);
        });
        
        $group = Group::find(1);
        
        
        $stuff = array(
            'activityId' => 1,
            'group' => $group
        );
        
        $this->action('POST', 'UserActivityController@addMany', null, $stuff);
        foreach($group->users as $user)
        {
            $this->seeInDatabase('activity_user', ['activityId' => 1, 'user_id' => (int)$user->id]);
        }
    }
   
}
