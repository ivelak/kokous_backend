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
			['partio_id' => $userData['attributes']['ref_code'][0]],
			['username' => $userData['attributes']['username'][0],
            'membernumber' => $userData['attributes']['username'][0],
            'postalcode' => $userData['attributes']['postalcode'][0],
            'is_scout' => $userData['attributes']['is_scout'][0],
            'email' => $userData['attributes']['email'][0],
            'firstname' => $userData['attributes']['firstname'][0],
            'lastname' => $userData['attributes']['lastname'][0]]
			);
        Auth::login($laravelUser);
    }

}
