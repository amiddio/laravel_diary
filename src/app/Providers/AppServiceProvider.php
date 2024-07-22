<?php

namespace App\Providers;

use App\View\Composers\CategoriesComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set Bootstrap 5 for pagination
        Paginator::useBootstrapFive();

        // Added copyright to all blade templates
        $current_year = date('Y');
        View::share('copyright', __("&copy; Copyright :years Crocus Studio", ['years' => ($current_year == 2024 ? $current_year : "2024-{$current_year}")]));

        // Share categories
        View::composer(['diary_posts.index', 'diary_posts.create', 'diary_posts.edit'], CategoriesComposer::class);
    }
}
