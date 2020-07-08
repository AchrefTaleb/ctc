<?php

namespace App\Policies;

use App\CategoryMail;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryMailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('categorymail-list')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\CategoryMail  $categoryMail
     * @return mixed
     */
    public function view(User $user, CategoryMail $categoryMail)
    {
        if ($user->can('categorymail-list')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\CategoryMail  $categoryMail
     * @return mixed
     */
    public function update(User $user, CategoryMail $categoryMail)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\CategoryMail  $categoryMail
     * @return mixed
     */
    public function delete(User $user, CategoryMail $categoryMail)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\CategoryMail  $categoryMail
     * @return mixed
     */
    public function restore(User $user, CategoryMail $categoryMail)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\CategoryMail  $categoryMail
     * @return mixed
     */
    public function forceDelete(User $user, CategoryMail $categoryMail)
    {
        //
    }
}
