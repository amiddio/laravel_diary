<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use App\Repositories\Interfaces\CreateInterface;
use App\Repositories\Interfaces\DeleteInterface;
use App\Repositories\Interfaces\ReadInterface;
use App\Repositories\Interfaces\UpdateInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class BlogPostRepository extends BaseRepository implements CreateInterface, DeleteInterface, ReadInterface, UpdateInterface
{
    private const CABINET_PER_PAGE = 10;

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
        $tags = Arr::get($data, 'tags', []);

        try {
            $post = $this->instance()->create($data);
            if ($tags) {
                $post->tags()->attach($tags);
            }
            self::setAlert(status: 'success', message: __('Blog post created successfully!'));
            return $post->id;
        } catch (QueryException  $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

    /**
     * @return Collection|LengthAwarePaginator
     */
    public function all(): Collection|LengthAwarePaginator
    {
        return $this->instance()->select(['id', 'title', 'is_active', 'published_at'])
            ->with('tags:id,name')
            ->owner()
            ->latest()
            ->paginate(self::CABINET_PER_PAGE);
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     * @throws AuthorizationException
     */
    public function find(int $id): \Illuminate\Database\Eloquent\Model
    {
        $post = $this->instance()->with('tags')->findOrFail($id);

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

        $tags = Arr::get($data, 'tags', []);
        $isTagsChanged = !($post->tags->modelKeys() == $tags);

        try {
            $post->fill($data);
            $post->save();
            if ($isTagsChanged) {
                $post->tags()->sync($tags);
            }
            if ($post->wasChanged() || $isTagsChanged) {
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
