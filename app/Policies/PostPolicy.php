<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Post;

class PostPolicy
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

    /**
     * Helper class to determine if given post can be updated by given user. User must be the owner of the post or be an Admin.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    protected function isOwner(User $user, Post $post)
    {
        // if User is an Admin, they can edit any post
        if ($user->isAdmin()) {
            return true;
        }
        // if User is a regular user, check if they own the post
        return $user->id === $post->user_id;
    }
    
    /**
     * Checks if owner can edit a post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function edit(User $user, Post $post)
    {
        return $this->isOwner($user, $post);
    }

    /**
     * Checks if owner can update a post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return $this->isOwner($user, $post);
    }

    /**
     * Checks if owner can delete a post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function delete(User $user, Post $post)
    {
        return $this->isOwner($user, $post);
    }

}
