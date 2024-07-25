<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @method static Builder|BaseModel active()
 * @method static Builder|BaseModel newModelQuery()
 * @method static Builder|BaseModel newQuery()
 * @method static Builder|BaseModel owner()
 * @method static Builder|BaseModel query()
 * @property-read mixed $published_at_formated
 * @mixin \Eloquent
 */
class BaseModel extends Model
{

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeOwner(Builder $query): void
    {
        $query->where('user_id', auth()->id());
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * @return Attribute
     */
    protected function publishedAtFormated(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->published_at)->format('l, jS \\of F Y, H:i'),
        );
    }

}
