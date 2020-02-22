<?php
namespace App\Policies;
use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any orders.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role > 0;
    }

    /**
     * Determine whether the user can view the order.
     *
     * @param  \App\Models\User  $user
     * @param  \App\odel=Models\Order  $order
     * @return mixed
     */
    public function view(User $user, Order $order)
    {
        return $user->role > 0 || $user->id == $order->user_id;
    }

    public function handleOrder(User $user, Order $order)
    {
        return $user->role > 0;
    }

    /**
     * Determine whether the user can create orders.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the order.
     *
     * @param  \App\Models\User  $user
     * @param  \App\odel=Models\Order  $order
     * @return mixed
     */
    public function update(User $user, Order $order)
    {
        return $user->role > 0 || $user->id == $order->user_id;
    }

    /**
     * Determine whether the user can delete the order.
     *
     * @param  \App\Models\User  $user
     * @param  \App\odel=Models\Order  $order
     * @return mixed
     */
    public function delete(User $user, Order $order)
    {
        return $user->role > 0 || $user->id == $order->user_id;
    }

    /**
     * Determine whether the user can restore the order.
     *
     * @param  \App\Models\User  $user
     * @param  \App\odel=Models\Order  $order
     * @return mixed
     */
    public function restore(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the order.
     *
     * @param  \App\Models\User  $user
     * @param  \App\odel=Models\Order  $order
     * @return mixed
     */
    public function forceDelete(User $user, Order $order)
    {
        //
    }
}
