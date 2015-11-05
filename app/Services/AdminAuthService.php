<?php

namespace App\Services;

use Session;

Class AdminAuthService
{

    public function isAdmin() {
        return Session::has('admin');
    }
    
    public function notAdmin() {
        return !Session::has('admin');
    }
    
    
}

