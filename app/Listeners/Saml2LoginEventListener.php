<?php

namespace App\Listeners;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Auth;

class Saml2LoginEventListener {

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Saml2LoginEvent  $event
     * @return void
     */
    public function handle(Saml2LoginEvent $event) {
        $user = $event->getSaml2User();
        $userData = [
            'id' => $user->getUserId(),
            'attributes' => $user->getAttributes(),
            'assertion' => $user->getRawSamlAssertion()
        ];
		//Debugaukseen. Poistakaa jossain kohtaa.
		//dd($userData);
		
        $laravelUser = User::updateOrCreate(
                ['membernumber' => array_get($userData, 'attributes.membernumber')],
                ['firstname' => array_get($userData, 'attributes.firstname'),
                'lastname' => array_get($userData, 'attributes.lastname')]);
        Auth::login($laravelUser);
    }

}
