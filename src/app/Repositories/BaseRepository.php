<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    /**
     * @var Model
     */
    private Model $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    abstract protected function getModelClass(): string;

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

    /**
     * @return Model
     */
    protected function instance(): Model
    {
        return $this->model;
    }

}
