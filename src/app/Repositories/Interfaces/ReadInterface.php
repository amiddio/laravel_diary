<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ReadInterface
{
    public function all(): Collection|LengthAwarePaginator;

    public function find(int $id): ?Model;
}
