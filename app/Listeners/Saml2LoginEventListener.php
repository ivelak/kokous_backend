<?php

namespace App\Listeners;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

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
		dd($userData);
		
        $laravelUser = User::updateOrCreate(
			['partio_id' => $userData['attributes']['id']],
			['username' => $userData['attributes']['username'],
            'membernumber' => $userData['attributes']['username'],
            'postalcode' => $userData['attributes']['postalcode'],
            'is_scout' => $userData['attributes']['is_scout'],
            'email' => $userData['attributes']['email'],
            'firstname' => $userData['attributes']['firstname'],
            'lastname' => $userData['attributes']['lastname']]
			);
        Auth::login($laravelUser);
    }

}
