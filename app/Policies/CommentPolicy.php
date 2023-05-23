<?php

namespace App\Policies;

use App\Models\User;
use App\Models\comment;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Client\Request;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, comment $comment)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user,Video $video)
    {
        return $user->id == $video->user_id ? Response::deny() : Response::allow();

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, comment $comment)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, comment $comment)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, comment $comment)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, comment $comment)
    {
        return true;
    }
}
