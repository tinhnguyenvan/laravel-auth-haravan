<?php

namespace App\Providers;

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
        $this->bootHaravanSocialite();
    }

    private function bootHaravanSocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend('haravan', function ($app) use ($socialite) {
            $config = $app['config']['services.haravan'];
            return $socialite->buildProvider(HaravanProvider::class, $config);
        });
    }
}
