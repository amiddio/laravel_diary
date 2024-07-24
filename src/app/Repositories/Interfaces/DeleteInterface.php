<?php

namespace App\Repositories\Interfaces;

interface DeleteInterface
{
    public function delete(int $id): void;
}
