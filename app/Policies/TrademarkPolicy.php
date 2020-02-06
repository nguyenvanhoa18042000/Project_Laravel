<?php

namespace App\Policies;

use App\Models\Trademark;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrademarkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any trademarks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role > 0 && $user->status == 1;
    }

    /**
     * Determine whether the user can view the trademark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trademark  $trademark
     * @return mixed
     */
    public function view(User $user, Trademark $trademark)
    {
        //
    }

    /**
     * Determine whether the user can create trademarks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 2 && $user->status == 1;
    }

    /**
     * Determine whether the user can update the trademark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trademark  $trademark
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->role == 2 && $user->status == 1;
    }

    /**
     * Determine whether the user can delete the trademark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trademark  $trademark
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->role == 2 && $user->status == 1;
    }

    /**
     * Determine whether the user can restore the trademark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trademark  $trademark
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->role == 2 && $user->status == 1;
    }

    /**
     * Determine whether the user can permanently delete the trademark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trademark  $trademark
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->role == 2 && $user->status == 1;
    }
}
