<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any topics.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can view the topic.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return mixed
     */
    public function view(User $user, Topic $topic)
    {
        //
    }

    /**
     * Determine whether the user can create topics.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can update the topic.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return mixed
     */
    public function update(User $user, Topic $topic)
    {
        return $user->role == 2 && $user->id == $topic->user_id;
    }

    /**
     * Determine whether the user can delete the topic.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return mixed
     */
    public function delete(User $user, Topic $topic)
    {
        return $user->role == 2 && $user->id == $topic->user_id;
    }

    /**
     * Determine whether the user can restore the topic.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return mixed
     */
    public function restore(User $user, Topic $topic)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the topic.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return mixed
     */
    public function forceDelete(User $user, Topic $topic)
    {
        //
    }
}
