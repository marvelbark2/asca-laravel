<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;


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
        setlocale(LC_TIME, "fr_FR");
        date_default_timezone_set('UTC');
        Carbon::setLocale('fr');
        // if (Auth::user()->id == '1') {
        //     return redirect('pending');
        // }
    }
}
