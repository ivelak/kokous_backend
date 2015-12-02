<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class NewEventViewTest extends TestCase {

    use DatabaseMigrations;

    private static function runFactory() {
        factory(App\Activity::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\Group::class, 5)->create();
        factory(App\Event::class, 5)->create();
    }

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
        
        self::runFactory();
        $this->visit('/events/new')
                ->type('Kokous', 'name')
                ->type('27.06.2018', 'date')
                ->type('16:30', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Helsinki', 'place')
                ->type('Iltakokous', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events'); //Ohjautuu tapahtumien listausnäkymään
    }

    public function testShowsErrorMessageWhenInvalidTimeInput() {
        $this->logIn();
        
        self::runFactory();
        $this->visit('/events/new')
                ->type('Kokous', 'name')
                ->type('27.06.2014', 'date')
                ->type('16:45', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Kamppi', 'place')
                ->type('Iltakokous', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The date must be a date after'); //Näyttää virheviestin liittyen menneeseen aikaan
    }

    public function testReturnsToCorrectViewWhenCancelIsPressed() {
        $this->logIn();
        
        self::runFactory();
        $this->visit('/events/new')
                ->type('Kokous', 'name')
                ->type('23.08.2016', 'date')
                ->type('16:45', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Pukinmäki', 'place')
                ->type('Iltakokous', 'description')
                ->click('Peruuta')
                ->seePageIs('/events'); //Palaa listausnäkymään
    }

    public function testShowsErrorMessageWhenNameIsNotEntered() {
        $this->logIn();
        
        self::runFactory();
        $this->visit('/events/new')
                ->type('', 'name')
                ->type('14.05.2016', 'date')
                ->type('18:30', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Helsinki', 'place')
                ->type('Kokous', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The name field is required'); //Virheviesti nimen puuttumisesta
    }

    public function testShowsErrorMessageWhenPlaceIsNotEntered() {
        $this->logIn();
        
        self::runFactory();
        $this->visit('/events/new')
                ->type('Tanssi', 'name')
                ->type('25.05.2017', 'date')
                ->type('20:30', 'time')
                ->type('', 'place')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Partiotanssit', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The place field is required'); //Virheviesti paikan puuttumisesta
    }

    public function testShowsErrorMessageWhenTimeIsNotInValidFormat() {
        $this->logIn();
        
        self::runFactory();
        $this->visit('/events/new')
                ->type('Pyöräily', 'name')
                ->type('25.06.2016', 'date')
                ->type('10.40', 'time')
                ->type('Konala', 'place')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Pyöräilyretki', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The time does not match the format H:i'); //Virheviesti ajan väärästä formaatista
    }

    public function testShowsErrorMessageWhenDateIsNotInValidFormat() {
        $this->logIn();
        
        self::runFactory();
        $this->visit('/events/new')
                ->type('Melonta', 'name')
                ->type('25-07-2016', 'date')
                ->type('16:40', 'time')
                ->select('1', 'groupId')
                ->uncheck('repeat')
                ->type('Munkkiniemi', 'place')
                ->type('Melontaretki', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The date does not match the format d.m.Y'); //Virheviesti päivämäärän väärästä formaatista
    }

    // Toiston validointi pitää tehdä ennen näiden toimimista!
    /* public function testShowsErrorMessageWhenEndindIsSetButEndDateNot() {
      self::runFactory();
      $this->visit('/events/new')
      ->type('Melonta', 'name')
      ->type('25.07.2016', 'date')
      ->type('16:40', 'time')
      ->check('ending')
      ->select('1', 'groupId')
      ->type('Munkkiniemi', 'place')
      ->type('Melontaretki', 'description')
      ->press('Lisää tapahtuma')
      ->seePageIs('/events/new');
      $this->visit('/events/new')
      ->setValues(array('days' => array('1')))
      ->see('The endDate is required');
      }

      public function testShowsErrorMessageWhenRepeatIsSetButWeekDayNot() {
      self::runFactory();
      $this->visit('/events/new')
      ->type('Melonta', 'name')
      ->type('25.07.2016', 'date')
      ->type('16:40', 'time')
      ->type('Munkkiniemi', 'place')
      ->type('Melontaretki', 'description')
      ->press('Lisää tapahtuma')
      ->seePageIs('/events/new')
      ->see('At least one day must be checked');
      } */
}
