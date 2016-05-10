<?php

namespace School\Students;

use Illuminate\Support\ServiceProvider;

class StudentsServiceProvider extends ServiceProvider {

    public function register() {
        include __DIR__ . '/Http/routes.php';
    }

    public function boot() {
        // Defines path for the view files.
        $this->loadViewsFrom(__DIR__ . '/../views/', 'student');
    }

}
