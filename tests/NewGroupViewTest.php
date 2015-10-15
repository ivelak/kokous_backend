<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Group;

class NewGroupViewTest extends TestCase {

    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRedirectsToCorrectViewWhenValidInput() {
        $this->visit('/groups/new')
                ->type('Test123','name')
                ->type('Test_group123','scout_group')
                ->type('Test_age_group123','age_group')
                ->press('Lisää ryhmä')
                
                ->seePageIs('/groups');
    }
    
    private function createUser()
    {
        $user = new User();
        $user->id = '1';
        $user->username = 'Teppo';
        $user->partio_id = '23123xc';
        $user->membernumber = '23123343';
        $user->postalcode = '00400';
        $user->is_scout = 'true';
        $user->email = 'matti@gmail.com';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';
        
        return $user->save();
    }
    
    private function createUser2()
    {
        $user = new User();
        $user->id = '2';
        $user->username = 'Matti';
        $user->partio_id = '23123xd';
        $user->membernumber = '23123342';
        $user->postalcode = '00400';
        $user->is_scout = 'true';
        $user->email = 'matti@gmail.com';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';
        $user->save();
    }
    
    public function testGroupIsAddedCorrectly() {
        self::createUser();
        self::createUser2();
        
        $this->visit('/groups/new')
                ->type('Test123','name')
                ->type('Test_group123','scout_group')
                ->type('Test_age_group123','age_group')
                ->select('1', 'participants')
                ->select('2', 'leaders')
                ->press('Lisää ryhmä');
        
        $this->seeInDatabase('groups', ['name'=>'Test123','scout_group'=>'Test_group123','age_group'=>'Test_age_group123']);
        $this->seeInDatabase('group_user', ['group_id' => 1, 'user_id' => 1, 'role' => 'member']);
        $this->seeInDatabase('group_user', ['group_id' => 1, 'user_id' => 2, 'role' => 'leader']);
    }
    
    public function testShowsErrorMessageWhenInvalidNameInput(){
        $this->visit('/groups/new')
                ->type('','name')
                ->type('Test_group123','scout_group')
                ->type('Test_age_group123','age_group')
                ->press('Lisää ryhmä')
                
                ->seePageIs('/groups/new')
                ->see('The name field is required');
    }
    
    public function testShowsErrorMessageWhenInvalidScoutGroupInput(){
        $this->visit('/groups/new')
                ->type('Test123','name')
                ->type('','scout_group')
                ->type('Test_age_group123','age_group')
                ->press('Lisää ryhmä')
                
                ->seePageIs('/groups/new')
                ->see('The scout group field is required');
    }
    
    public function testShowsErrorMessageWhenInvalidAgeGroupInput(){
        $this->visit('/groups/new')
                ->type('Test123','name')
                ->type('Test_group123','scout_group')
                ->type('','age_group')
                ->press('Lisää ryhmä')
                
                ->seePageIs('/groups/new')
                ->see('The age group field is required');
    }

}
