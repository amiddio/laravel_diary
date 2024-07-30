<?php

namespace App\Repositories;

use App\Enums\LikeDislikeEnum;
use App\Exceptions\LikeDislikeException;
use App\Models\LikeDislike as Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class LikeDislikeRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @throws LikeDislikeException
     */
    public function update(array $data): ?int
    {
        Arr::set($data, 'user_id', auth()->id());

        // Set vote
        if ($data['like'] && !$data['dislike']) {
            Arr::set($data, 'vote', LikeDislikeEnum::LIKE);
        } elseif (!$data['like'] && $data['dislike']) {
            Arr::set($data, 'vote', LikeDislikeEnum::DISLIKE);
        } else {
            throw new LikeDislikeException(__('A vote is not set'));
        }

        // Get vote if exist
        $record = $this->getByCondition(modelType: $data['model_type'], modelId: $data['model_id']);
        if ($record && $record->vote == $data['vote']) {
            throw new LikeDislikeException(__('You have already voted'));
        }

        // Update or create
        try {
            if ($record) {
                $record->update(['vote' => $data['vote']]);
                return $record->id;
            } else {
                $vote = $this->instance()->create($data);
                return $vote->id;
            }
        } catch (QueryException  $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

    /**
     * @param string $modelType
     * @param string $modelId
     * @return array<string, int>
     */
    public function getVotes(string $modelType, string $modelId): array
    {
        $likes = $this->getCount(modelType: $modelType, modelId: $modelId, vote: LikeDislikeEnum::LIKE);
        $dislikes = $this->getCount(modelType: $modelType, modelId: $modelId, vote: LikeDislikeEnum::DISLIKE);

        return [
            'likes' => $likes,
            'dislikes' => $dislikes,
            'total_votes' => $likes + $dislikes,
        ];
    }

    /**
     * @param string $modelType
     * @param string $modelId
     * @param int $vote
     * @return int
     */
    private function getCount(string $modelType, string $modelId, int $vote): int
    {
        return $this->instance()
            ->where('model_type', $modelType)
            ->where('model_id', $modelId)
            ->where('vote', $vote)
            ->count();
    }

    /**
     * @param string $modelType
     * @param string $modelId
     * @return Model|null
     */
    private function getByCondition(string $modelType, string $modelId): ?Model
    {
        return $this->instance()
            ->where('user_id', auth()->id())
            ->where('model_type', $modelType)
            ->where('model_id', $modelId)
            ->first();
    }
}
