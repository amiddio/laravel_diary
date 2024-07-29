<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CreateInterface;
use App\Repositories\Interfaces\DeleteInterface;
use App\Repositories\Interfaces\ReadInterface;
use App\Repositories\Interfaces\UpdateInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

abstract class BaseCrudRepository extends BaseRepository implements CreateInterface, DeleteInterface, UpdateInterface, ReadInterface
{

    /**
     * @param int $id
     * @return ?Model
     */
    public function find(int $id): ?Model
    {
        return $this->instance()->find($id);
    }

    /**
     * @param Model $instance
     * @param array $data
     * @return Model
     */
    public function update(Model $instance, array $data): Model
    {
        try {
            $instance->fill($data);
            $instance->save();
            return $instance;
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

    /**
     * @param Model $instance
     * @return ?bool
     */
    public function delete(Model $instance): ?bool
    {
        try {
            return $instance->delete();
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

}
