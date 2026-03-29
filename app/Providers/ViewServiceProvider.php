<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // View Composer: Truyền danh sách Categories tới file bố cục dùng chung 'layouts.master'
        View::composer('layouts.master', function ($view) {
            $categories = \App\Models\Category::all();
            $brands = \App\Models\Brand::all();
            
            $view->with('categories', $categories);
            $view->with('brands', $brands);
        });
    }
}
