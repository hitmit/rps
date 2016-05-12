<?php

namespace School\Events;

use Illuminate\Support\ServiceProvider;

class EventsServiceProvider extends ServiceProvider
{
    public function register()
    {
        include __DIR__ . '/Http/routes.php';
    }

    public function boot()
    {
        // Defines path for the view files.
        $this->loadViewsFrom(__DIR__ . '/../views/', 'events');
    }
}

