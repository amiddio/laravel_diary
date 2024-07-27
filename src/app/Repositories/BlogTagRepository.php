<?php

namespace App\Repositories;

use App\Models\BlogTag as Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class BlogTagRepository extends BaseCrudRepository
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
        Arr::set($data, 'user_id', auth()->id());

        try {
            $tag = $this->instance()->create($data);
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
        $columns = ['id', 'name'];

        $tags = $this->instance()
            ->select($columns)
            ->owner()
            ->orderBy('name')
            ->get();

        return $tags;
    }

}
