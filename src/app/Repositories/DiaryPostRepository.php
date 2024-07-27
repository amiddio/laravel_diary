<?php

namespace App\Repositories;

use App\Models\DiaryPost as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class DiaryPostRepository extends BaseCrudRepository
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
        Arr::set($data, 'user_id', auth()->id());

        try {
            $post = $this->instance()->create($data);
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

}
