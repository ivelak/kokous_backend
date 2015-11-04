<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller {

    public function login(Request $request) {
        if ($request->input('password') == 'admin') {
            $request->session()->put('admin', '1');
            return redirect('/');
        } else {
            abort(403);
        }
    }

    public function show() {
        return view('admin');
    }

}
