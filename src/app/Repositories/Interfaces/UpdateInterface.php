<?php

namespace App\Repositories\Interfaces;

interface UpdateInterface
{
    public function update(array $data, int $id): void;
}
