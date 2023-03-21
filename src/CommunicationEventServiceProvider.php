<?php

namespace D3cr33\Communication;

use D3cr33\Communication\Events\CommunicationAsync;
use D3cr33\Communication\Listeners\CommunicationAsyncListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CommunicationEventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CommunicationAsync::class   =>  [
            CommunicationAsyncListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
