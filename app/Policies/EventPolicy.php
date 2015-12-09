<?php

namespace App\Policies;

use App\Event;
use App\User;
use App\Group;
use App\Admin;

class EventPolicy {

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function manageForGroup(User $user, Group $group) {
        return $group->leaders->contains($user);
    }

    public function manage(User $user, Event $event) {
        return $event->group->leaders->contains($user);
    }

    public function before() {
        if (Admin::isAdmin()) {
            return true;
        }
    }

}
