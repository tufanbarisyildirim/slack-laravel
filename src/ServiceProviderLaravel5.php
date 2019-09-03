<?php

namespace Javfres\Slack;

use Nexy\Slack\Client;


class ServiceProviderLaravel5 extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/config/config.php' => config_path('slack.php')]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'slack');

        $this->app->singleton('javfres.slack', function($app) {

            return new ClientProxy($app);          

        });

        $this->app->bind('Javfres\Slack\ClientProxy', 'javfres.slack');
    
    }
}
