<?php

namespace App\Repositories;

class BaseRepository
{

    /**
     * @param string $status
     * @param string $message
     * @return void
     */
    protected static function setAlert(string $status, string $message): void
    {
        request()->session()->flash('status', $status);
        request()->session()->flash('message', $message);
    }
}
