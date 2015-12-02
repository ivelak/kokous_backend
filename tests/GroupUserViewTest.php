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
    private function logIn() {
        $user = new User();
        $user->membernumber = '23123342';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';
        
        $user->save();
        
        Auth::login($user);
    }
    
    public function testCorrectViewSeen() {
        $this->logIn();
        session()->set('admin',1);
        
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
        $this->logIn();
        
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
        $this->logIn();
        
        $group = new Group();
        $group->name = 'TestiRyhmä';
        $group->scout_group = 'Lippukunta';
        $group->age_group = 'Ikäryhmä';

        $group->save();
        
        $user = new User();
        $user->id = '23';
        $user->membernumber = '23123342';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';
        
        $user->save();
        

        $this->visit('/groups/1/users')
             ->press('Lisää ryhmän jäsen')
             ->see('Matti')
             ->see('Poista');
    }
    
    public function testUserCanBeRemovedFromTheGroup() {
        $this->logIn();
        
        $group = new Group();
        $group->name = 'TestiRyhmä';
        $group->scout_group = 'Lippukunta';
        $group->age_group = 'Ikäryhmä';

        $group->save();
        
        $user = new User();
        $user->id = '23';
        $user->membernumber = '2312334212';
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
