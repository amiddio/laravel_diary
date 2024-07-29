<?php

namespace App\Models;

use App\Observers\BlogPostObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string $intro
 * @property string $content
 * @property bool $is_active
 * @property Carbon $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $published_at_formated
 * @property-read Collection<int, BlogTag> $tags
 * @property-read int|null $tags_count
 * @method static Builder|BlogPost active()
 * @method static Builder|BlogPost newModelQuery()
 * @method static Builder|BlogPost newQuery()
 * @method static Builder|BlogPost owner()
 * @method static Builder|BlogPost query()
 * @method static Builder|BlogPost whereContent($value)
 * @method static Builder|BlogPost whereCreatedAt($value)
 * @method static Builder|BlogPost whereId($value)
 * @method static Builder|BlogPost whereIntro($value)
 * @method static Builder|BlogPost whereIsActive($value)
 * @method static Builder|BlogPost wherePublishedAt($value)
 * @method static Builder|BlogPost whereSlug($value)
 * @method static Builder|BlogPost whereTitle($value)
 * @method static Builder|BlogPost whereUpdatedAt($value)
 * @method static Builder|BlogPost whereUserId($value)
 * @mixin \Eloquent
 */
class BlogPost extends BaseModel
{
    use HasFactory;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'intro' => 'string',
        'content' => 'string',
        'is_active' => 'boolean',
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'intro',
        'content',
        'is_active',
        'published_at',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class);
    }

    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::observe(BlogPostObserver::class);
    }
}
