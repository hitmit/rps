<?php

namespace School\Academic;

use Illuminate\Support\ServiceProvider;

class AcademicServiceProvider extends ServiceProvider
{
    public function register()
    {
        include __DIR__ . '/Http/routes.php';
    }

    public function boot()
    {

        // Defines path for the view files.
        $this->loadViewsFrom(__DIR__ . '/../views/', 'academic');

        // Defines the files which are going to published.
        $this->publishes([
            __DIR__ .'/Migrations/2016_04_19_143711_create_academic_year.php' => base_path('database/migrations/2016_04_19_143711_create_academic_year.php'),
        ]);

    }
}

