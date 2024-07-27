<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface DeleteInterface
{
    public function delete(Model $instance): ?bool;
}
