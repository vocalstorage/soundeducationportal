<?php

namespace App\Providers;

use App\Schoolgroup;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['admin.lesson.create','admin.lesson.edit' ], function($view){
           $view->with('schoolgroups', Schoolgroup::all());
        });

        setlocale(LC_TIME, 'nl_NL');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
