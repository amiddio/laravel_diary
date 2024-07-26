<?php

namespace App\Repositories;

use App\Models\BlogTag as Model;
use App\Repositories\Interfaces\CreateInterface;
use App\Repositories\Interfaces\DeleteInterface;
use App\Repositories\Interfaces\ReadInterface;
use App\Repositories\Interfaces\UpdateInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class BlogTagRepository extends BaseRepository implements CreateInterface, DeleteInterface, UpdateInterface, ReadInterface
{

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param array $data
     * @return int
     */
    public function create(array $data): int
    {
        $data = Arr::set($data, 'user_id', auth()->id());

        try {
            $tag = $this->instance()->create($data);
            self::setAlert(status: 'success', message: __('Tag created successfully!'));
            return $tag->id;
        } catch (QueryException  $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->instance()->select(['id', 'name'])->owner()->orderBy('name')->get();
    }

    /**
     * @param int $id
     * @return Model
     * @throws AuthorizationException
     */
    public function find(int $id): Model
    {
        $tag = $this->instance()->findOrFail($id);

        Gate::authorize('view', $tag);

        return $tag;
    }

    /**
     * @param array $data
     * @param int $id
     * @return void
     * @throws AuthorizationException
     */
    public function update(array $data, int $id): void
    {
        $tag = $this->instance()->findOrFail($id);

        Gate::authorize('update', $tag);

        try {
            $tag->fill($data);
            $tag->save();
            if ($tag->wasChanged()) {
                self::setAlert(status: 'success', message: __('Tag edited successfully!'));
            }
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

    /**
     * @param int $id
     * @return void
     * @throws AuthorizationException
     */
    public function delete(int $id): void
    {
        $tag = $this->instance()->findOrFail($id);

        Gate::authorize('delete', $tag);

        try {
            $tag->delete();
            self::setAlert(status: 'success', message: __('Tag was deleted!'));
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

}
