<?php

namespace App\Repositories;

use App\Models\BlogPost;
use App\Repositories\Interfaces\CreateInterface;
use App\Repositories\Interfaces\DeleteInterface;
use App\Repositories\Interfaces\ReadInterface;
use App\Repositories\Interfaces\UpdateInterface;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class BlogPostRepository extends BaseRepository implements CreateInterface, DeleteInterface, ReadInterface, UpdateInterface
{
    const CABINET_PER_PAGE = 10;

    public function create(array $data): int
    {
        $data = Arr::set($data, 'user_id', auth()->id());

        try {
            $tag = BlogPost::create($data);
            self::setAlert(status: 'success', message: __('Blog post created successfully!'));
            return $tag->id;
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
        return BlogPost::select(['id', 'title', 'is_active', 'published_at'])
                        ->owner()
                        ->latest()
                        ->paginate(self::CABINET_PER_PAGE);
    }

    /**
     * @param int $id
     * @return BlogPost
     */
    public function find(int $id): BlogPost
    {
        $post = BlogPost::findOrFail($id);

        Gate::authorize('view', $post);

        return $post;
    }

    /**
     * @param array $data
     * @param int $id
     * @return void
     */
    public function update(array $data, int $id): void
    {
        $post = BlogPost::findOrFail($id);

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
     */
    public function delete(int $id): void
    {
        $post = BlogPost::findOrFail($id);

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
