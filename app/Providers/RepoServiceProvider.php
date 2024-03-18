<?php

namespace App\Providers;

use App\Repository\FeesRepository;
use App\Repository\StudentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\FeesRepositoryInterface;
use App\Repository\StudentGraduatedRepository;
use App\Repository\StudentPromotionRepository;
use App\Repository\StudentRepositoryInterface;
use App\Repository\StudentGraduatedRepositoryInterface;
use App\Repository\StudentPromotionRepositoryInterface;

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
        $this->app->bind(StudentPromotionRepositoryInterface::class,StudentPromotionRepository::class);
        $this->app->bind(StudentRepositoryInterface::class,StudentRepository::class);
        $this->app->bind(StudentGraduatedRepositoryInterface::class,StudentGraduatedRepository::class);
        $this->app->bind(FeesRepositoryInterface::class,FeesRepository::class);
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
