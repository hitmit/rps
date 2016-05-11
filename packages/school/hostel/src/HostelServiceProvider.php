<?php

namespace School\Hostel;

use Illuminate\Support\ServiceProvider;

class HostelServiceProvider extends ServiceProvider
{
    public function register()
    {
        include __DIR__ . '/Http/routes.php';
    }

    public function boot()
    {
        // Defines path for the view files.
        $this->loadViewsFrom(__DIR__ . '/../views/', 'hostel');
    }
}

