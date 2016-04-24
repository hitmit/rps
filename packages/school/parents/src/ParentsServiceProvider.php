<?php

namespace School\Parents;

use Illuminate\Support\ServiceProvider;

class ParentsServiceProvider extends ServiceProvider {

    public function register() {
        include __DIR__ . '/Http/routes.php';
    }

    public function boot() {
        // Defines path for the view files.
        $this->loadViewsFrom(__DIR__ . '/../views/', 'parent');
    }

}
