<?php

namespace App\Providers;

use App\Repository\FeesRepository;
use App\Repository\PaymentRepository;
use App\Repository\StudentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\AttendanceRepository;
use App\Repository\FeeInvoicesRepository;
use App\Repository\FeesRepositoryInterface;
use App\Repository\ProcessingFeeRepository;
use App\Repository\ReceiptStudentsRepository;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\StudentGraduatedRepository;
use App\Repository\StudentPromotionRepository;
use App\Repository\StudentRepositoryInterface;
use App\Repository\AttendanceRepositoryInterface;
use App\Repository\FeeInvoicesRepositoryInterface;
use App\Repository\ProcessingFeeRepositoryInterface;
use App\Repository\ReceiptStudentsRepositoryInterface;
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
        $this->app->bind(FeeInvoicesRepositoryInterface::class,FeeInvoicesRepository::class);
        $this->app->bind(ReceiptStudentsRepositoryInterface::class,ReceiptStudentsRepository::class);
        $this->app->bind(ProcessingFeeRepositoryInterface::class,ProcessingFeeRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class,PaymentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class,AttendanceRepository::class);

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
