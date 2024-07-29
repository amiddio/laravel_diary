<?php

namespace App\Repositories\Cabinet;

use App\Models\BlogPost as Model;
use App\Repositories\BaseCrudRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class BlogPostRepository extends BaseCrudRepository
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
        $columns = ['id', 'title', 'is_active', 'published_at'];

        $posts = $this->instance()
            ->select($columns)
            ->with('tags:id,name')
            ->owner()
            ->latest()
            ->paginate(self::CABINET_PER_PAGE);

        return $posts;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $post
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     * @throws AuthorizationException
     */
    public function update(\Illuminate\Database\Eloquent\Model $post, array $data): \Illuminate\Database\Eloquent\Model
    {
        $tags = Arr::get($data, 'tags', []);
        $isTagsChanged = !($post->tags->modelKeys() == $tags);

        try {
            $post->fill($data);
            $post->save();
            if ($isTagsChanged) {
                $post->tags()->sync($tags);
            }
            $post->setAttribute('is_tags_changed', $isTagsChanged);
            return $post;
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

}
