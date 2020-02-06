<?php

namespace App\Policies;

use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any news categories.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return ($user->role > 0 && $user->status == 1);
    }

    /**
     * Determine whether the user can view the news category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return mixed
     */
    public function view(User $user, NewsCategory $newsCategory)
    {
        // return ($user->role > 0 && $user->status == 1);
    }

    /**
     * Determine whether the user can create news categories.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->role > 0 && $user->status == 1);
    }

    /**
     * Determine whether the user can update the news category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return mixed
     */
    public function update(User $user, NewsCategory $newsCategory)
    {
        return ($user->role == 2 && $user->status == 1) || ($user->id == $newsCategory->user_id && $user->status == 1);
    }

    /**
     * Determine whether the user can delete the news category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return mixed
     */
    public function delete(User $user, NewsCategory $newsCategory)
    {
        return ($user->role == 2 && $user->status == 1);
    }

    /**
     * Determine whether the user can restore the news category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return mixed
     */
    public function restore(User $user, NewsCategory $newsCategory)
    {
        return ($user->role == 2 && $user->status == 1);
    }

    /**
     * Determine whether the user can permanently delete the news category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return mixed
     */
    public function forceDelete(User $user, NewsCategory $newsCategory)
    {
        return ($user->role == 2 && $user->status == 1);
    }
}
