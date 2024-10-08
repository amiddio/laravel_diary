<?php

namespace App\View\Composers;

use App\Repositories\Cabinet\CategoryRepository;
use Illuminate\View\View;

class CategoriesComposer
{

    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {}

    public function compose(View $view): void
    {
        $view->with('categories', $this->categoryRepository->activeList());
    }
}
