<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\PatientRepository;
use App\Interface\PatientRepositoryInterface;
use App\Services\PatientService;

use App\Repository\AppointmentRepository;
use App\Interface\AppointmentRepositoryInterface;
use App\Services\AppointmentService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(PatientService::class, function ($app) {
            return new PatientService($app->make(PatientRepositoryInterface::class));
        });

        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(AppointmentService::class, function ($app) {
            return new AppointmentService($app->make(AppointmentRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
