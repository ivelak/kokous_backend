<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
