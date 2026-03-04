<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Tasks\Repositories\TaskRepositoryInterface;
use App\Infrastructure\Tasks\EloquentTaskRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, EloquentTaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
