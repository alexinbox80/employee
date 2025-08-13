<?php

namespace App\Providers;

use App\Repositories\Contracts\DivisionContract as DivisionRepositoryContract;
use App\Repositories\Contracts\EmployeeContract as EmployeeRepositoryContract;
use App\Repositories\Contracts\StatusContract as StatusRepositoryContract;
use App\Repositories\Contracts\ScheduleContract as ScheduleRepositoryContract;
use App\Repositories\DivisionRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\StatusRepository;
use App\Services\Contracts\DivisionContract as DivisionServiceContract;
use App\Services\Contracts\EmployeeContract as EmployeeServiceContract;
use App\Services\Contracts\StatusContract as StatusServiceContract;
use App\Services\Contracts\ScheduleContract as ScheduleServiceContract;
use App\Services\Contracts\ResponseContract;
use App\Services\EmployeeService;
use App\Services\ResponseService;
use App\Services\ScheduleService;
use App\Services\StatusService;
use App\Services\DivisionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ResponseContract::class, ResponseService::class);

        $this->app->bind(EmployeeServiceContract::class, EmployeeService::class);
        $this->app->bind(EmployeeRepositoryContract::class, EmployeeRepository::class);

        $this->app->bind(DivisionServiceContract::class, DivisionService::class);
        $this->app->bind(DivisionRepositoryContract::class, DivisionRepository::class);

        $this->app->bind(StatusServiceContract::class, StatusService::class);
        $this->app->bind(StatusRepositoryContract::class, StatusRepository::class);

        $this->app->bind(ScheduleServiceContract::class, ScheduleService::class);
        $this->app->bind(ScheduleRepositoryContract::class, ScheduleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
