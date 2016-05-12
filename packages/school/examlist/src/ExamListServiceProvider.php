<?php

namespace School\ExamList;

use Illuminate\Support\ServiceProvider;

class ExamListServiceProvider extends ServiceProvider
{
    public function register()
    {
        include __DIR__ . '/Http/routes.php';
    }

    public function boot()
    {
        // Defines path for the view files.
        $this->loadViewsFrom(__DIR__ . '/../views/', 'examlist');
    }
}

