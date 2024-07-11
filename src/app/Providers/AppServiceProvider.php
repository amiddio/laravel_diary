<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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

        // Added copyright to all blade templates
        $current_year = date('Y');
        View::share('copyright', __("&copy; Copyright :years Crocus Studio", ['years' => ($current_year == 2024 ? $current_year : "2024-{$current_year}")]));
    }
}
