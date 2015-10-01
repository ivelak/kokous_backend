<?php

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
    public function testCorrectlyCreatedGroupSeenOnView() {
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
        $this->visit('/groups')
             ->see('Ei ryhmiä');
    }

}
