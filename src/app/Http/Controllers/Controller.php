<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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
