<?php

namespace App\Policies;

use App\Mail;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailPolicy
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
        if ($user->can('mail-list')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mail  $mail
     * @return mixed
     */
    public function view(User $user, Mail $mail)
    {
        if ($user->can('mail-list')) {
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
        if ($user->can('mail-create')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mail  $mail
     * @return mixed
     */
    public function update(User $user, Mail $mail)
    {
        if ($user->can('mail-update')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mail  $mail
     * @return mixed
     */
    public function delete(User $user, Mail $mail)
    {
        if ($user->can('mail-delete')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mail  $mail
     * @return mixed
     */
    public function restore(User $user, Mail $mail)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mail  $mail
     * @return mixed
     */
    public function forceDelete(User $user, Mail $mail)
    {
        //
    }
}
