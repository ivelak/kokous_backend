<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function imageable(){
        return $this->morphTo();
    }
}
