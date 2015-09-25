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
             ->type('Marko','name')
             ->type('27.03.2016','date')
             ->type('23:45','time')
             ->type('Onkalo','place')
             ->type('Kuvaus','description')
             ->press('Lisää tapahtuma')
             ->seePageIs('/events')
        
             ->seeInDatabase('events', ['name'=>'Marko','place'=>'Onkalo', 'description'=>'Kuvaus']);
           
        
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
        
             ->notSeeInDatabase('events', ['place'=>'Kukkula', 'description'=>'Kuvaus']);
             
    }
    
}
