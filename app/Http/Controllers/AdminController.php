<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;

class AdminController extends Controller {

    public function login(Request $request) {
        if ($request->input('password') == 'admin') {
            $request->session()->put('admin', '1');
            return back()->with('message', 'Kirjautuminen hallintopaneeliin onnistui!');
        } else {
            abort(403, 'No you don\'t');
        }
    }
    
    public function logout(Request $request) {
        $request->session()->forget('admin');
        return back()->with('message', 'Uloskirjautuminen hallintopaneelista onnistui!');
    }

    public function show() {
        return view('admin');
    }

}
