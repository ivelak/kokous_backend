<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewEventViewTest extends TestCase {

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRedirectsToCorrectViewWhenValidInput() {
        $this->visit('/events/new')
                ->type('Kokous', 'name')
                ->type('27.06.2018', 'date')
                ->type('16:30', 'time')
                ->check('repeat')
                ->select('2', 'interval')
                ->type('27.06.2018', 'endDate')
                ->type('Helsinki', 'place')
                ->type('Iltakokous', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events'); //Ohjautuu tapahtumien listausnäkymään
    }

    public function testShowsErrorMessageWhenInvalidTimeInput() {
        $this->visit('/events/new')
                ->type('Kokous', 'name')
                ->type('27.06.2014', 'date')
                ->type('16:45', 'time')
                ->check('repeat')
                ->select('2', 'interval')
                ->type('27.06.2018', 'endDate')
                ->type('Kamppi', 'place')
                ->type('Iltakokous', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The date must be a date after'); //Näyttää virheviestin liittyen menneeseen aikaan
    }

    public function testReturnsToCorrectViewWhenCancelIsPressed() {
        $this->visit('/events/new')
                ->type('Kokous', 'name')
                ->type('23.08.2016', 'date')
                ->type('16:45', 'time')
                ->check('repeat')
                ->select('2', 'interval')
                ->type('27.06.2018', 'endDate')
                ->type('Pukinmäki', 'place')
                ->type('Iltakokous', 'description')
                ->click('Peruuta')
                ->seePageIs('/events'); //Palaa listausnäkymään
    }

    public function testShowsErrorMessageWhenNameIsNotEntered() {
        $this->visit('/events/new')
                ->type('', 'name')
                ->type('14.05.2016', 'date')
                ->type('18:30', 'time')
                ->check('repeat')
                ->select('2', 'interval')
                ->type('27.06.2018', 'endDate')
                ->type('Helsinki', 'place')
                ->type('Kokous', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The name field is required'); //Virheviesti nimen puuttumisesta
    }

    public function testShowsErrorMessageWhenPlaceIsNotEntered() {
        $this->visit('/events/new')
                ->type('Tanssi', 'name')
                ->type('25.05.2017', 'date')
                ->type('20:30', 'time')
                ->check('repeat')
                ->select('2', 'interval')
                ->type('27.06.2018', 'endDate')
                ->type('', 'place')
                ->type('Partiotanssit', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The place field is required'); //Virheviesti paikan puuttumisesta
    }

    public function testShowsErrorMessageWhenTimeIsNotInValidFormat() {
        $this->visit('/events/new')
                ->type('Pyöräily', 'name')
                ->type('25.06.2016', 'date')
                ->type('10.40', 'time')
                ->check('repeat')
                ->select('2', 'interval')
                ->type('27.06.2018', 'endDate')
                ->type('Konala', 'place')
                ->type('Pyöräilyretki', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The time does not match the format H:i'); //Virheviesti ajan väärästä formaatista
    }

    public function testShowsErrorMessageWhenDateIsNotInValidFormat() {
        $this->visit('/events/new')
                ->type('Melonta', 'name')
                ->type('25-07-2016', 'date')
                ->type('16:40', 'time')
                ->check('repeat')
                ->select('2', 'interval')
                ->type('27.06.2018', 'endDate')
                ->type('Munkkiniemi', 'place')
                ->type('Melontaretki', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The date does not match the format d.m.Y'); //Virheviesti päivämäärän väärästä formaatista
    }

    public function testShowsErrorMessageWhenEndDateIsNotInValidFormat() {
        $this->visit('/events/new')
                ->type('Melonta', 'name')
                ->type('25.07.2016', 'date')
                ->type('16:40', 'time')
                ->check('repeat')
                ->select('2', 'interval')
                ->type('27-06-2018', 'endDate')
                ->type('Munkkiniemi', 'place')
                ->type('Melontaretki', 'description')
                ->press('Lisää tapahtuma')
                ->seePageIs('/events/new')
                ->see('The date does not match the format d.m.Y'); //Virheviesti päivämäärän väärästä formaatista
    }

}
