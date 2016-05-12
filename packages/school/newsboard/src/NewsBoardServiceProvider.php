<?php

namespace School\Newsboard;

use Illuminate\Support\ServiceProvider;

class NewsBoardServiceProvider extends ServiceProvider
{
    public function register()
    {
        include __DIR__ . '/Http/routes.php';
    }

    public function boot()
    {
        // Defines path for the view files.
        $this->loadViewsFrom(__DIR__ . '/../views/', 'newsboard');
    }
}

