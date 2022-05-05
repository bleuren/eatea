<?php

namespace App\Policies;

use App\Models\OrderItemSub;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderItemSubPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderItemSub  $orderItemSub
     * @return mixed
     */
    public function view(User $user, OrderItemSub $orderItemSub)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderItemSub  $orderItemSub
     * @return mixed
     */
    public function update(User $user, OrderItemSub $orderItemSub)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderItemSub  $orderItemSub
     * @return mixed
     */
    public function delete(User $user, OrderItemSub $orderItemSub)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderItemSub  $orderItemSub
     * @return mixed
     */
    public function restore(User $user, OrderItemSub $orderItemSub)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderItemSub  $orderItemSub
     * @return mixed
     */
    public function forceDelete(User $user, OrderItemSub $orderItemSub)
    {
        //
    }
}
