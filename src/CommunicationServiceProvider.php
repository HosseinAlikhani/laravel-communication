<?php

namespace D3cr33\Communication;

use Illuminate\Support\ServiceProvider;

class CommunicationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // register event service provider
        app()->register(CommunicationEventServiceProvider::class);

        $this->mergeConfigFrom(__DIR__.'/../Config/communication.php', 'communication');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublishing();
        $this->loadRequirements();
    }


    /**
     * load requirements section
     */
    private function loadRequirements()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__.'/../Lang', 'communication');
    }

    /**
     * register publishing file
     */
    private function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../Config/communication.php' => config_path('communication.php'),
        ], 'communication-config');
    }
}
