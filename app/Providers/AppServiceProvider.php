<?php

namespace App\Providers;

use App\Repositories\Contracts\DivisionContract;
use App\Repositories\Contracts\EmployeeContract;
use App\Repositories\DivisionRepository;
use App\Repositories\EmployeeRepository;
use App\Services\Contracts\PageContract;
use App\Services\PageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PageContract::class, PageService::class);
        $this->app->bind(EmployeeContract::class, EmployeeRepository::class);
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
