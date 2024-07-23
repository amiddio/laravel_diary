<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @property-read \App\Models\Category|null $category
 * @property-read mixed $intro
 * @property-read mixed $published_at_formated
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiaryPost whereUserId($value)
 * @mixin \Eloquent
 */
class DiaryPost extends Model
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function intro(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::words($this->content, 15),
        );
    }

    protected function publishedAtFormated(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->published_at)->format('l, jS \\of F Y, H:i'),
        );
    }

}
