<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user){
        return $user->role > 0 && $user->status == 1;
    }

    public function isAdmin(User $user){
        return $user->role == 2 && $user->status == 1;
    }

    public function check(User $user){
        return $user->role > 0 && $user->status == 1;
    }
}
