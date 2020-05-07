<?php

namespace App\Providers;

use App\Events\FreshNasaCallEvent;
use App\Listeners\DBQueryListener;
use App\Listeners\RedisQueryListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        FreshNasaCallEvent::class => [
            DBQueryListener::class,
            RedisQueryListener::class,
        ],
    ];
}
