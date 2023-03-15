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
        if(env('USE_PUBLIC_WWW',false)){
            $this->app->bind('path.public', function() {
                return base_path().'/www';
            });
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if(env('DB_QUERY_LOGGING',false)){
          \DB::listen(function($query) {
              logger($query->sql,$query->bindings);
          });
        }
    }
}
