<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\Models\CategoryNews;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $category=DB::table('category')->where('status',1)->get();
        $category_news=CategoryNews::where('status',true)->get();
        view()->share('category', $category);
        view()->share('category_news', $category_news);
    }
}
