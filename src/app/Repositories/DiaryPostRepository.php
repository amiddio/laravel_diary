<?php

namespace App\Repositories;

use App\Models\DiaryPost as Model;
use App\Repositories\Interfaces\CreateInterface;
use App\Repositories\Interfaces\DeleteInterface;
use App\Repositories\Interfaces\ReadInterface;
use App\Repositories\Interfaces\UpdateInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class DiaryPostRepository extends BaseRepository implements CreateInterface, ReadInterface, UpdateInterface, DeleteInterface
{

    private const PER_PAGE = 10;

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
            $post = $this->instance()->create($data);
            self::setAlert(status: 'success', message: __('Post created successfully!'));
            return $post->id;
        } catch (QueryException  $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

    /**
     * @param string|null $slug
     * @return Collection|LengthAwarePaginator
     */
    public function all(?string $slug = null): Collection|LengthAwarePaginator
    {
        $query = $this->instance()
            ->with(['category' => function ($q) {
                $q->select('id', 'name', 'slug');
            }])
            ->owner()
            ->orderByDesc('published_at');

        if ($slug !== null) {
            $query = $query->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }

        return $query->paginate(self::PER_PAGE);
    }

    /**
     * @param int $id
     * @return Model
     * @throws AuthorizationException
     */
    public function find(int $id): Model
    {
        $post = $this->instance()->findOrFail($id);

        Gate::authorize('view', $post);

        return $post;
    }

    /**
     * @param array $data
     * @param int $id
     * @return void
     * @throws AuthorizationException
     */
    public function update(array $data, int $id): void
    {
        $post = $this->instance()->findOrFail($id);

        Gate::authorize('update', $post);

        try {
            $post->fill($data);
            $post->save();
            if ($post->wasChanged()) {
                self::setAlert(status: 'success', message: __('Post updated successfully!'));
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
        $post = $this->instance()->findOrFail($id);

        Gate::authorize('delete', $post);

        try {
            $post->delete();
            self::setAlert(status: 'success', message: __('Post was deleted!'));
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

}
