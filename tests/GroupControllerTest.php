<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\GroupController;
use App\Group;
use App\User;

class GroupControllerTest extends TestCase {

    use DatabaseMigrations;

    private function logIn() {
        $user = new User();
        $user->membernumber = '23123342';
        $user->firstname = 'Matti';
        $user->lastname = 'Jateppo';

        $user->save();

        Auth::login($user);
    }

    public function setUp() {
        
        parent::setUp();
        $this->controller = new GroupController();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGroupCreatedWithCorrectRequirements() {
        $this->logIn();
        session()->set('admin',1);
        
        $this->visit('/groups/new')
                ->type('Test123', 'name')
                ->type('Test_group123', 'scout_group')
                ->type('sudenpennut', 'age_group')
                ->press('Lisää ryhmä')
                ->seePageIs('/groups')
                ->seeInDatabase('groups', ['name' => 'Test123', 'scout_group' => 'Test_group123', 'age_group' => 'sudenpennut']);
    }

    public function testIndex() {
        $this->logIn();
        session()->set('admin',1);
        
        $this->action('GET', 'GroupController@index');
        $this->seePageIs('/groups');
    }

    public function testCreate() {
        $this->logIn();
        session()->set('admin',1);
        
        $this->action('GET', 'GroupController@create');
        $this->seePageIs('/groups/new');
    }

    private static function createTestGroup() {
        
        $group = new Group();
        $group->name = 'Test123';
        $group->scout_group = 'Test_group123';
        $group->age_group = 'sudenpennut';
        $group_id = $group->save();
        return $group_id;
    }

    public function testShow() {
        $this->logIn();
        
        $group_id = self::createTestGroup();

        $this->action('GET', 'GroupController@show', ['id' => $group_id]);

        $this->seePageIs('/groups/' . $group_id);
    }

    public function testEdit() {
        $this->logIn();
        session()->set('admin',1);

        $group_id = self::createTestGroup();

        $this->action('GET', 'GroupController@edit', ['id' => $group_id]);

        $this->see('Muokkaa ryhmää');
    }

    public function testDestroy() {
        $this->logIn();
        session()->set('admin',1);

        $group_id = self::createTestGroup();

        $this->seeInDatabase('groups', ['name' => 'Test123', 'scout_group' => 'Test_group123', 'age_group' => 'sudenpennut']);

        $this->controller->destroy($group_id);

        $this->notSeeInDatabase('groups', ['name' => 'Test123', 'scout_group' => 'Test_group123', 'age_group' => 'sudenpennut']);
    }

    public function testGroupIsNotCreatedWithoutName() {
        $this->logIn();
        session()->set('admin',1);
        
        $this->visit('/groups/new')
                ->type('', 'name')
                ->type('Test_group123', 'scout_group')
                ->type('sudenpennut', 'age_group')
                ->press('Lisää ryhmä')
                ->seePageIs('/groups/new')
                ->notSeeInDatabase('groups', ['scout_group' => 'Test_group123', 'age_group' => 'sudenpennut']);
    }

    public function testGroupIsNotCreatedWithoutScoutGroup() {
        $this->logIn();
        session()->set('admin',1);
        
        $this->visit('/groups/new')
                ->type('Test123', 'name')
                ->type('', 'scout_group')
                ->type('sudenpennut', 'age_group')
                ->press('Lisää ryhmä')
                ->seePageIs('/groups/new')
                ->notSeeInDatabase('groups', ['name' => 'Test123', 'age_group' => 'sudenpennut']);
    }

}
