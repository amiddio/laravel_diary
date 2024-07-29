<?php

namespace App\Repositories\Cabinet;

use App\Models\Category as Model;
use App\Repositories\BaseCrudRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CategoryRepository extends BaseCrudRepository
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
            $category = $this->instance()->create($data);
            return $category->id;
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
        $columns = ['id', 'name', 'is_active'];

        $categories = $this->instance()
            ->select($columns)
            ->owner()
            ->orderBy('name')
            ->toBase()
            ->get();

        return $categories;
    }

    /**
     * @return array
     */
    public function activeList(): array
    {
        $columns = ['id', 'name', 'slug'];

        $categories = $this->instance()
            ->select($columns)
            ->owner()
            ->active()
            ->orderBy('name')
            ->get();

        $categories = Arr::mapWithKeys($categories->toArray(), function (array $item, int $key) {
            return [$item['id'] => $item];
        });

        return $categories;
    }

}
