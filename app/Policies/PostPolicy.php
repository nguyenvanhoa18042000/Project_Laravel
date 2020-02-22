<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role > 0 && $user->status == 1;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role > 0 && $user->status == 1;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return ($user->role == 2 && $user->status == 1) || ($user->id == $post->user_id && $user->status == 1);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return ($user->role == 2 && $user->status == 1) || ($user->id == $post->user_id && $user->status == 1);
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        return ($user->role == 2 && $user->status == 1) || ($user->id == $post->user_id && $user->status == 1);
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        return ($user->role == 2 && $user->status == 1) || ($user->id == $post->user_id && $user->status == 1);
    }

    public function changeHot(User $user, Post $post){
        return ($user->role == 2 && $user->status == 1) || ($user->id == $post->user_id && $user->status == 1) ;
    }

    public function notChangeHot(User $user, Post $post){
        return $user->role != 2 || $user->id != $post->user_id ;
    }
}
