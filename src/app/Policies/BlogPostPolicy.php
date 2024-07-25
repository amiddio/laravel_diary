<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPostPolicy extends BasePolicy
{
    /**
     * @param User $user
     * @param BlogPost $tag
     * @return Response
     */
    public function view(User $user, BlogPost $tag): Response
    {
        return self::isOwner(
            user: $user, instance: $tag, message: __('You are not allowed to view this post')
        );
    }

    /**
     * @param User $user
     * @param BlogPost $tag
     * @return Response
     */
    public function update(User $user, BlogPost $tag): Response
    {
        return self::isOwner(
            user: $user, instance: $tag, message: __('You are not allowed to update this post')
        );
    }

    /**
     * @param User $user
     * @param BlogPost $tag
     * @return Response
     */
    public function delete(User $user, BlogPost $tag): Response
    {
        return self::isOwner(
            user: $user, instance: $tag, message: __('You are not allowed to delete this post')
        );
    }
}
