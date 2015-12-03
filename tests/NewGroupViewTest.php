<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Group;

class NewGroupViewTest extends TestCase {

    use DatabaseMigrations;
    
     private function logIn() {
        $user = new User();
        $user->membernumber = '23123342';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';

        $user->save();

        Auth::login($user);
    }
    
    public function testRedirectsToCorrectViewWhenValidInput() {
        $this->logIn();
        session()->set('admin',1);
        
        $this->visit('/groups/new')
                ->type('Test123','name')
                ->type('Test_group123','scout_group')
                ->type('sudenpennut','age_group')
                ->press('Lisää ryhmä')
                
                ->seePageIs('/groups');
    }
    
    private function createUser()
    {
        $user = new User();
        $user->membernumber = '23123343';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';
        
        return $user->save();
    }
    
    private function createUser2()
    {
        $user = new User();
        $user->membernumber = '231233342';
        $user->firstname = 'Matti';
        $user->lastname = 'Repo';
        $user->save();
    }
    
    public function testGroupIsAddedCorrectly() {
        $this->logIn();
        session()->set('admin',1);
        
        self::createUser();
        self::createUser2();
        
        $this->visit('/groups/new')
                ->type('Test123','name')
                ->type('Test_group123','scout_group')
                ->type('sudenpennut','age_group')
                ->select('1', 'participants')
                ->select('2', 'leaders')
                ->press('Lisää ryhmä');
        
        $this->seeInDatabase('groups', ['name'=>'Test123','scout_group'=>'Test_group123','age_group'=>'sudenpennut']);
        $this->seeInDatabase('group_user', ['group_id' => 1, 'user_id' => 1, 'role' => 'member']);
        $this->seeInDatabase('group_user', ['group_id' => 1, 'user_id' => 2, 'role' => 'leader']);
    }
    
    public function testShowsErrorMessageWhenInvalidNameInput(){
        $this->logIn();
        session()->set('admin',1);
        
        $this->visit('/groups/new')
                ->type('','name')
                ->type('Test_group123','scout_group')
                ->type('sudenpennut','age_group')
                ->press('Lisää ryhmä')
                
                ->seePageIs('/groups/new')
                ->see('The name field is required');
    }
    
    public function testShowsErrorMessageWhenInvalidScoutGroupInput(){
        $this->logIn();
        session()->set('admin',1);
        
        $this->visit('/groups/new')
                ->type('Test123','name')
                ->type('','scout_group')
                ->type('sudenpennut','age_group')
                ->press('Lisää ryhmä')
                
                ->seePageIs('/groups/new')
                ->see('The scout group field is required');
    }


}
