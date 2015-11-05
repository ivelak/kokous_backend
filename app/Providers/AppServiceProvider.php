<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\POFBackend;
use App\Services\AdminAuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		if ($this->app->environment() == 'local') {
			$this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
			$this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
		}
                
                $this->app->bind('pof', function($app){
                    return new POFBackend();                
                });
                
                $this->app->bind('admin', function($app){
                    return new AdminAuthService();
                });
    }
}
