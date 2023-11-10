<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewDashboard(User $user)
    {
        return $user->admin;
    }

    public function __construct()
    {
        //
    }
}
