<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LikeDislike extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'vote' => 'integer',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'model_id',
        'model_type',
        'vote',
    ];

    /**
     * @return MorphTo
     */
    public function likedislikeable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }

}
