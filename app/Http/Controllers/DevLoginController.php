<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\User;
use Auth;

class DevLoginController extends Controller {

    public function login() {
        $user = User::firstOrCreate([
            'membernumber'=>'0000000',
            'firstname'=>'Jonne',
            'lastname'=>'Partiolainen'
        ]);
        Auth::login($user);
        return back()->with('message', 'Kirjautuminen onnistui!');
    }

    public function logout(Request $request) {
        Auth::logout();
        return back()->with('message', 'uloskirjautuminen onnistui!');
    }

}
