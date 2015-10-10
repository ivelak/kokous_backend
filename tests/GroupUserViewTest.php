<?php

use App\User;
use App\Group;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupUserViewTest extends TestCase {
    
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCorrectViewSeen() {
        $group = new Group();
        $group->name = 'TestiRyhmä';
        $group->scout_group = 'Lippukunta';
        $group->age_group = 'Ikäryhmä';

        $group->save();

        $this->visit('/groups/1/users')
             ->see('TestiRyhmä')
             ->see('Ryhmän jäsenet')
             ->see('Ei lisättyjä ryhmäläisiä');
    }
    
    public function testCorrectViewSeenWhenBackPressed() {
        $group = new Group();
        $group->name = 'TestiRyhmä';
        $group->scout_group = 'Lippukunta';
        $group->age_group = 'Ikäryhmä';

        $group->save();

        $this->visit('/groups/1/users')
             ->click('Takaisin')
             ->see('Ryhmänjohtajat:')
             ->see('Ryhmän nimi:')
             ->see('Tulevat tapahtumat:');
    }
    
    public function testUserCanBeAddedToTheGroup() {
        $group = new Group();
        $group->name = 'TestiRyhmä';
        $group->scout_group = 'Lippukunta';
        $group->age_group = 'Ikäryhmä';

        $group->save();
        
        $user = new User();
        $user->id = '23';
        $user->username = 'Matti';
        $user->partio_id = '23123xc';
        $user->membernumber = '23123342';
        $user->postalcode = '00400';
        $user->is_scout = 'true';
        $user->email = 'matti@gmail.com';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';
        
        $user->save();
        

        $this->visit('/groups/1/users')
             ->press('Lisää ryhmän jäsen')
             ->see('Matti')
             ->see('Poista');
    }
    
    public function testUserCanBeRemovedFromTheGroup() {
        $group = new Group();
        $group->name = 'TestiRyhmä';
        $group->scout_group = 'Lippukunta';
        $group->age_group = 'Ikäryhmä';

        $group->save();
        
        $user = new User();
        $user->id = '23';
        $user->username = 'Liisa';
        $user->partio_id = '23123afxc';
        $user->membernumber = '2312334212';
        $user->postalcode = '00330';
        $user->is_scout = 'true';
        $user->email = 'liisa@gmail.com';
        $user->firstname = 'Liisa';
        $user->lastname = 'Saarenmaa';
        
        $user->save();
        

        $this->visit('/groups/1/users')
             ->press('Lisää ryhmän jäsen')
             ->see('Liisa')
             ->press('Poista')
             ->dontSee('Poista');
    }
    

}
