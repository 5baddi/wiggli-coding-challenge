<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use App\Models\PersonalAccessToken;
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
        class_alias(PersonalAccessToken::class, \Laravel\Sanctum\PersonalAccessToken::class);
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
