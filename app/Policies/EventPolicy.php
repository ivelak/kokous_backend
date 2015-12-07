<?php

namespace App\Policies;

use App\Event;
use App\User;

class EventPolicy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function manage(User $user, Event $event){
        return $event->group->leaders->contains($user);
    }
    
    public function create(User $user){
        return $event->group->leaders->contains($user);
    }
}
