<?php

namespace App\Models;

use App\Observers\BlogPostObserver;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @property \Illuminate\Support\Carbon $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereUserId($value)
 * @method static Builder|BlogPost active()
 * @method static Builder|BlogPost owner()
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
     * @return void
     */
    protected static function booted(): void
    {
        static::observe(BlogPostObserver::class);
    }
}
