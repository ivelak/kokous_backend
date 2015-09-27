<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Event;

class EventControllerTest extends TestCase
{   
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEventCreatedWithCorrectRequirements()
    {   
        //$this->call('POST','events/new',['name'=>'Marko','date'=>'27.03.2016','time'=>'23:45','place'=>'Onkalo', 'description'=>'Kaikilla on kivaa', '_token'=>'csrf_token()']);
        //echo dd($response);
        //$this->seeInDatabase('events',['name'=>'Marko']);
        
        $this->visit('/events/new')
             ->type('Hippa','name')
             ->type('27.03.2016','date')
             ->type('23:45','time')
             ->type('Onkalo','place')
             ->type('Kuvaus','description')
             ->press('Lisää tapahtuma')
             ->seePageIs('/events')
        
             ->seeInDatabase('events', ['name'=>'Hippa','time'=>'2016-03-27 23:45:00','place'=>'Onkalo', 'description'=>'Kuvaus']);   
    }
    
    public function testIndex(){
        $this->action('GET', 'EventController@index');
        $this -> seePageIs('/events');
    }
    
    public function testCreate(){
        $this->action('GET', 'EventController@create');
        $this -> seePageIs('/events/new');
    }
    
    public function testShow(){
        $event = new Event();
        $event->name = 'Leiri';
        $event->time = '2018-06-25 16:40:00';
        $event->place = 'Rauma';
        $event->description = 'Onginta';
        
        $event->save();
        
        $event_id = DB::table('events')->where('name', 'Leiri')->value('id');
        
        $this->action('GET','EventController@show',['id' => $event_id]);
        
        $this->seePageIs('/events/'.$event_id);
    }
    
    public function testEdit(){
        $event = new Event();
        $event->name = 'Kokous';
        $event->time = '2016-07-25 16:40:00';
        $event->place = 'Kolo';
        $event->description = 'Iltakokous';
        
        $event->save();
        
        $event_id = DB::table('events')->where('name', 'Kokous')->value('id');
        
        $this->action('GET','EventController@edit', ['id' => $event_id]);
        
        $this->see('Muokkaa tapahtumaa');
        
    }
    
    public function testDestroy(){
        $event = new Event();
        $event->name = 'Iltakokous';
        $event->time = '2016-03-25 16:45:00';
        $event->place = 'Kolo';
        $event->description = 'Viikottainen kokous';
        
        $event->save();
        
        $this->seeInDatabase('events', ['name'=>'Iltakokous','time'=>'2016-03-25 16:45:00','place'=>'Kolo', 'description'=>'Viikottainen kokous']);
        
        $event_id = DB::table('events')->where('name', 'Iltakokous')->value('id');
        
        $this->action('GET','EventController@destroy', ['id' => $event_id]);
        
        $this->seeInDatabase('events', ['name'=>'Iltakokous','time'=>'2016-03-25 16:45:00','place'=>'Kolo', 'description'=>'Viikottainen kokous']);
    }
    
    /*public function testEventIsSavedIntoDatabaseWhenInputIsValid(){
        
        
        $this->withoutMiddleware()->call('POST','events/new', ['csrf_token'=>csrf_token(),'name'=>'Marko','date'=>'27.03.2016','time'=>'23:45','place'=>'Onkalo', 'description'=>'Kaikilla on kivaa']);
        $this->seePageIs('/events/new');
    }*/
    
    public function testEventIsNotCreatedWithoutName(){
        $this->visit('/events/new')
             ->type('','name')
             ->type('30.04.2016','date')
             ->type('23:40','time')
             ->type('Kukkula','place')
             ->type('Kuvaus','description')
             ->press('Lisää tapahtuma')
                
             ->seePageIs('/events/new')
        
             ->notSeeInDatabase('events', ['place'=>'Kukkula','time'=>'2016-04-30 23:40:00', 'description'=>'Kuvaus']);
             
    }
    
    public function testEventIsNotCreatedWithPastDate(){
        $this->visit('/events/new')
             ->type('Jumppa','name')
             ->type('15.07.2014','date')
             ->type('21:43','time')
             ->type('Helsinki','place')
             ->type('Kuvaus','description')
             ->press('Lisää tapahtuma')
                
             ->seePageIs('/events/new')
        
             ->notSeeInDatabase('events', ['name'=>'Jumppa','place'=>'Helsinki','time'=>'2014-07-15 21:43:00', 'description'=>'Kuvaus']);
    }
    
    public function testEventIsCreatedWithoutDescription(){
        $this->visit('/events/new')
             ->type('Ilmakitaraturnaus','name')
             ->type('25.06.2018','date')
             ->type('16:20','time')
             ->type('Helsinki','place')
             ->type('','description')
             ->press('Lisää tapahtuma')
                
             ->seePageIs('/events')
        
             ->SeeInDatabase('events', ['name'=>'Ilmakitaraturnaus','place'=>'Helsinki','time'=>'2018-06-25 16:20:00', 'description'=>'']);
    }
   
}
