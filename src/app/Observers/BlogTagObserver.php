<?php

namespace App\Observers;

use App\Models\BlogTag;
use Illuminate\Support\Str;

class BlogTagObserver
{
    /**
     * @param BlogTag $tag
     * @return void
     */
    public function saving(BlogTag $tag): void
    {
        $tag_name = request('name');
        $tag_name = Str::lower($tag_name);
        if ($tag_name !== $tag->name) {
            $tag->setAttribute('name', $tag_name);
        }
    }
}
