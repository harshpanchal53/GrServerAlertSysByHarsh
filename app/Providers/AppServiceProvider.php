<?php

namespace App\Providers;
use Illuminate\Support\Facades\App;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (App::runningInConsole()) {
            $this->app->resolving(Schedule::class, function (Schedule $schedule) {
                $schedule->command('servers:check-status')->everyMinute();
            });
        }
    }
}
