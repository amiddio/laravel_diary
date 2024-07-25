<?php

namespace App\Models;

use App\Observers\BlogTagObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogTag whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlogPost> $posts
 * @property-read int|null $posts_count
 * @mixin \Eloquent
 */
class BlogTag extends Model
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
