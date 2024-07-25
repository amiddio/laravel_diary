<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * @param BlogPost $post
     * @return void
     */
    public function saving(BlogPost $post): void
    {
        $post_title = request('title');
        $post_slug = Str::slug($post_title);
        if ($post_slug != $post->slug) {
            $post->setAttribute('slug', $post_slug);
        }
    }
}
