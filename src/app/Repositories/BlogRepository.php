<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Database\Eloquent\Builder;

class BlogRepository extends BaseRepository
{
    private const PER_PAGE = 10;

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function list(?string $tag_name = null): LengthAwarePaginator
    {
        $columns = ['id', 'user_id', 'title', 'slug', 'intro', 'published_at'];

        $posts = $this->instance()
            ->select($columns)
            ->with(['tags:id,name', 'user:id,name'])
            ->whereHas('tags', function ($query) use ($tag_name) {
                if ($tag_name) {
                    $query->where('name', $tag_name);
                }
            })
            ->active()
            ->orderByDesc('published_at')
            ->paginate(self::PER_PAGE);

        return $posts;
    }

    /**
     * @param string $user_id
     * @param string $slug
     * @return ?Model
     */
    public function detail(string $user_id, string $slug): ?Model
    {
        $columns = ['id', 'title', 'user_id', 'content', 'published_at'];

        $post = $this->instance()
            ->select($columns)
            ->with(['tags:id,name', 'user:id,name'])
            ->active()
            ->where('user_id', $user_id)
            ->where('slug', $slug)
            ->active()
            ->first();

        return $post;
    }

}
