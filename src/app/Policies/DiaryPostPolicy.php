<?php

namespace App\Policies;

use App\Models\DiaryPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DiaryPostPolicy extends BasePolicy
{
    /**
     * @param User $user
     * @param DiaryPost $post
     * @return Response
     */
    public function view(User $user, DiaryPost $post): Response
    {
        return self::isOwner(
            user: $user, instance: $post, message: __('You are not allowed to view this diary post')
        );
    }

    /**
     * @param User $user
     * @param DiaryPost $post
     * @return Response
     */
    public function update(User $user, DiaryPost $post): Response
    {
        return self::isOwner(
            user: $user, instance: $post, message: __('You are not allowed to update this diary post')
        );
    }

    /**
     * @param User $user
     * @param DiaryPost $post
     * @return Response
     */
    public function delete(User $user, DiaryPost $post): Response
    {
        return self::isOwner(
            user: $user, instance: $post, message: __('You are not allowed to delete this diary post')
        );
    }
}
