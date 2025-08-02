<?php

namespace App\Providers;

use App\Repositories\Contracts\DivisionContract;
use App\Repositories\Contracts\EmployeeContract as EmployeeRepositoryContract;
use App\Repositories\DivisionRepository;
use App\Repositories\EmployeeRepository;
use App\Services\Contracts\EmployeeContract as EmployeeServiceContract;
use App\Services\EmployeeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmployeeServiceContract::class, EmployeeService::class);
        $this->app->bind(EmployeeRepositoryContract::class, EmployeeRepository::class);
        $this->app->bind(DivisionContract::class, DivisionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
