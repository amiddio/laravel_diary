<?php

namespace App\Models;

use App\Observers\BlogTagObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|BlogTag newModelQuery()
 * @method static Builder|BlogTag newQuery()
 * @method static Builder|BlogTag query()
 * @method static Builder|BlogTag whereCreatedAt($value)
 * @method static Builder|BlogTag whereId($value)
 * @method static Builder|BlogTag whereName($value)
 * @method static Builder|BlogTag whereUpdatedAt($value)
 * @method static Builder|BlogTag whereUserId($value)
 * @property-read Collection<int, BlogPost> $posts
 * @property-read int|null $posts_count
 * @mixin \Eloquent
 */
class BlogTag extends BaseModel
{
    use HasFactory;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class);
    }

    protected static function booted(): void
    {
        static::observe(BlogTagObserver::class);
    }
}
