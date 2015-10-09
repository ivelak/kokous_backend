<?php

namespace App;

use Illuminate\Support\Facades\Facade;

class POF extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'pof'; }
}

