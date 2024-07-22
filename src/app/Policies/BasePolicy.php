<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\Response;

class BasePolicy
{
    protected static function isOwner(User $user, Model $instance, string $message): Response
    {
        return $user->id === $instance->user_id ? Response::allow() : Response::deny($message);
    }
}
