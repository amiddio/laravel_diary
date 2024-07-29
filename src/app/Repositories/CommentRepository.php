<?php

namespace App\Repositories;

use App\Models\Comment as Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class CommentRepository extends BaseRepository implements Interfaces\CreateInterface
{
    private const PER_PAGE = 10;

    private const COMMENTABLE_TYPE = 'blog';

    /**
     * @inheritDoc
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
        Arr::set($data, 'commentable_type', self::COMMENTABLE_TYPE);

        try {
            $comment = $this->instance()->create($data);
            return $comment->id;
        } catch (QueryException  $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

    /**
     * @param int $post_id
     * @return LengthAwarePaginator
     */
    public function all(int $post_id): LengthAwarePaginator
    {
        $columns = ['id', 'user_id', 'commentable_id', 'content', 'created_at'];

        $comments = $this->instance()
            ->select($columns)
            ->with(['user:id,name'])
            ->where('commentable_type', self::COMMENTABLE_TYPE)
            ->where('commentable_id', $post_id)
            ->orderByDesc('created_at')
            ->paginate(self::PER_PAGE);

        return $comments;
    }
}
