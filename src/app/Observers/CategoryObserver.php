<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * @param Category $category
     * @return void
     */
    public function saving(Category $category): void
    {
        $category_name = request('name');
        $category_slug = Str::slug($category_name);
        if ($category_slug != $category->slug) {
            $category->setAttribute('slug', $category_slug);
        }
    }

}
