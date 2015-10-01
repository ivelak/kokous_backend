<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
