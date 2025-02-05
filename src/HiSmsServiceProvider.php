<?php

namespace Shreifelagamy\Hisms;

use Illuminate\Support\ServiceProvider;

class HiSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/hisms.php';
        $this->publishes([
            $configPath => config_path('hisms.php')
        ]);

        $this->mergeConfigFrom($configPath, 'hisms');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hisms', function ($app) {
            $config = $app['config']['hisms'] ?: $app['config']['hisms::config'];
            return new HismsClient($config['Username'], $config['Password'], $config['SenderName']);
        });
    }

    public function provides()
    {
        return ['hisms'];
    }
}
