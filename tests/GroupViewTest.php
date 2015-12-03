<?php

use App\User;
use App\Group;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupViewTest extends TestCase {

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
     private function logIn() {
        $user = new User();
        $user->membernumber = '23123342';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';

        $user->save();

        Auth::login($user);
    }
       
    public function testCorrectlyCreatedGroupSeenOnView() {
        $this->logIn();
        
        $group = new Group();
        $group->name = 'Test123';
        $group->scout_group = 'Test_group123';
        $group->age_group = 'Test_age_group123';

        $group->save();
        
        $this->seeInDatabase('groups', ['name' => 'Test123'])
                ->visit('/groups')
                ->see('Test123');
    }
    
    public function testCorrectViewWhenNoGroupsAdded() {
        $this->logIn();
        
        $this->visit('/groups')
             ->see('Ei ryhmiä');
    }
    
    public function testCorrectlyCreatedGroupSeenOnView1() {
        $this->logIn();
        
        $group = new Group();
        $group->name = 'Sudenpennut';
        $group->scout_group = 'Test_ScoutGroup';
        $group->age_group = 'Test_AgeGroup';

        $group->save();
        
        $this->visit('/groups/1')
                ->see('Sudenpennut')
                ->see('Test_ScoutGroup')
                ->see('Test_AgeGroup');
    }
    
     public function testCorrectFieldsSeenInTheView() {
        $this->logIn();
         
        $group = new Group();
        $group->name = 'RyhmäA';
        $group->scout_group = 'Lippulaiset';
        $group->age_group = 'Vuotiaat';

        $group->save();
        
        $this->visit('/groups/1')
                ->see('Ryhmän nimi:')
                ->see('Lippukunta:')
                ->see('Ikäryhmä:')
                ->see('Tulevat tapahtumat:')
                ->see('RyhmäA')
                ->see('Lippulaiset')
                ->see('Vuotiaat');
    }
    
    public function testGroupCanBeDeleted() {
        $this->logIn();
        session()->set('admin',1);
        
        $group = new Group();
        $group->name = 'RyhmäA';
        $group->scout_group = 'Lippulaiset';
        $group->age_group = 'Vuotiaat';

        $group->save();
        
        $this->visit('/groups/1')
                ->press('Poista')
                ->seePageIs('/groups')
                ->dontSee('RyhmäA');      
    }
    
}
