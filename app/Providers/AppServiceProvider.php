<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Reconocimiento;
use Carbon\Carbon;

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
        Paginator::useBootstrap();

        Reconocimiento::created(function($reconocimiento){
            $date = Carbon::now();
            $date = $date->format('Ymd');
            $reconocimiento->codigo = 'FET' . $date . $reconocimiento->id;
            $reconocimiento->save();
        });
    }
}
