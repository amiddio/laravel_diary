<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy extends BasePolicy
{

    /**
     * @param User $user
     * @param Category $category
     * @return Response
     */
    public function view(User $user, Category $category): Response
    {
        return self::isOwner(
            user: $user, instance: $category, message: __('You are not allowed to view this category')
        );
    }

    /**
     * @param User $user
     * @param Category $category
     * @return Response
     */
    public function update(User $user, Category $category): Response
    {
        return self::isOwner(
            user: $user, instance: $category, message: __('You are not allowed to update this category')
        );
    }

    /**
     * @param User $user
     * @param Category $category
     * @return Response
     */
    public function delete(User $user, Category $category): Response
    {
        return self::isOwner(
            user: $user, instance: $category, message: __('You are not allowed to delete this category')
        );
    }

}
