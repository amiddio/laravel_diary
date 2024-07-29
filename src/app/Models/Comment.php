<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

class Comment extends BaseModel
{
    use HasFactory;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'content' => 'string',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'content',
    ];

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return Attribute
     */
    protected function publishedAtFormated(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format(config('custom.date_formated.general')),
        );
    }

}
