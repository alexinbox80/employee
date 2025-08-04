<?php

namespace App\Providers;

use App\Repositories\Contracts\DivisionContract;
use App\Repositories\Contracts\EmployeeContract as EmployeeRepositoryContract;
use App\Repositories\Contracts\StatusContract as StatusRepositoryContract;
use App\Repositories\DivisionRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\StatusRepository;
use App\Services\Contracts\EmployeeContract as EmployeeServiceContract;
use App\Services\Contracts\StatusContract as StatusServiceContract;
use App\Services\EmployeeService;
use App\Services\StatusService;
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
        $this->app->bind(StatusServiceContract::class, StatusService::class);
        $this->app->bind(StatusRepositoryContract::class, StatusRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
