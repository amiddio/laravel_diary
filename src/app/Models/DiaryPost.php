<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
