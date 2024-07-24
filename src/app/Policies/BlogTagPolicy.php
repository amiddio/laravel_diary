<?php

namespace App\Policies;

use App\Models\BlogTag;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogTagPolicy extends BasePolicy
{
    /**
     * @param User $user
     * @param BlogTag $tag
     * @return Response
     */
    public function view(User $user, BlogTag $tag): Response
    {
        return self::isOwner(
            user: $user, instance: $tag, message: __('You are not allowed to view this tag')
        );
    }

    /**
     * @param User $user
     * @param BlogTag $tag
     * @return Response
     */
    public function update(User $user, BlogTag $tag): Response
    {
        return self::isOwner(
            user: $user, instance: $tag, message: __('You are not allowed to update this tag')
        );
    }

    /**
     * @param User $user
     * @param BlogTag $tag
     * @return Response
     */
    public function delete(User $user, BlogTag $tag): Response
    {
        return self::isOwner(
            user: $user, instance: $tag, message: __('You are not allowed to delete this tag')
        );
    }
}
