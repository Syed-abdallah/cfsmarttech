<?php

namespace App\Providers;
use App\Models\Marquee;
use Illuminate\Support\Facades\View; // ✅ Correct Import
use Illuminate\Support\ServiceProvider;

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
        // View::composer('*', function ($view) {
        //     $marquees = Marquee::where('is_active', 1)->get();
        //     $view->with('marquees', $marquees);
        // });
    }
}
