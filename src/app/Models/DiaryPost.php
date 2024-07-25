<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $category_id
 * @property string $title
 * @property string $content
 * @property Carbon $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read mixed $intro
 * @property-read mixed $published_at_formated
 * @method static Builder|DiaryPost newModelQuery()
 * @method static Builder|DiaryPost newQuery()
 * @method static Builder|DiaryPost query()
 * @method static Builder|DiaryPost whereCategoryId($value)
 * @method static Builder|DiaryPost whereContent($value)
 * @method static Builder|DiaryPost whereCreatedAt($value)
 * @method static Builder|DiaryPost whereId($value)
 * @method static Builder|DiaryPost wherePublishedAt($value)
 * @method static Builder|DiaryPost whereTitle($value)
 * @method static Builder|DiaryPost whereUpdatedAt($value)
 * @method static Builder|DiaryPost whereUserId($value)
 * @mixin \Eloquent
 */
class DiaryPost extends BaseModel
{
    use HasFactory;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'category_id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'published_at',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return Attribute
     */
    protected function intro(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::words($this->content, 15),
        );
    }

}
