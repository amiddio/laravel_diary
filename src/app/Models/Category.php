<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'is_active' => 'boolean',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'is_active',
    ];

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::observe(CategoryObserver::class);
    }
}
