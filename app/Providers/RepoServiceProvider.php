<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\StudentPromotionRepositoryInterface;
use App\Repository\StudentPromotionRepository;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repository\TeacherRepositoryInterface', 'App\Repository\TeacherRepository');
        $this->app->bind('App\Repository\StudentRepositoryInterface', 'App\Repository\StudentRepository');
        $this->app->bind(
            StudentPromotionRepositoryInterface::class,
            StudentPromotionRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
