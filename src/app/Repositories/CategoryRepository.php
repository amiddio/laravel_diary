<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CreateInterface;
use App\Repositories\Interfaces\DeleteInterface;
use App\Repositories\Interfaces\ReadInterface;
use App\Repositories\Interfaces\UpdateInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class CategoryRepository implements CreateInterface, ReadInterface, UpdateInterface, DeleteInterface
{

    /**
     * @param array $data
     * @return int
     */
    public function create(array $data): int
    {
        $data = Arr::set($data, 'user_id', auth()->id());

        try {
            $category = Category::create($data);
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
        return Category::select(['id', 'name', 'is_active'])
                         ->where('user_id', auth()->id())
                         ->orderBy('name')
                         ->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): Category
    {
        $category = Category::findOrFail($id);

        Gate::authorize('view', $category);

        return $category;
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $category = $this->find($id);

        Gate::authorize('update', $category);

        try {
            $category->fill($data);
            $category->save();
            return $category->wasChanged();
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
        $category = $this->find($id);

        Gate::authorize('delete', $category);

        try {
            $category->delete();
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

}
