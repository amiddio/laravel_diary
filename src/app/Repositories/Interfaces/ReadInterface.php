<?php

namespace App\Repositories\Interfaces;

interface ReadInterface
{
    public function all();

    public function find(int $id);
}
