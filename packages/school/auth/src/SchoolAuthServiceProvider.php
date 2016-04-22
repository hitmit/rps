<?php

namespace School\Auth;

use Illuminate\Support\ServiceProvider;

class SchoolAuthServiceProvider extends ServiceProvider {

    public function register() {
        include __DIR__ . '/Http/routes.php';
    }

    public function boot() {
        // Defines path for the view files.
        $this->loadViewsFrom(__DIR__ . '/../views/', 'auth');
    }

}
