<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\GoalObserver;
use App\Models\Goal\Goal;
use App\Observers\UserObserver;
use App\Models\User\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Goal::observe(GoalObserver::class);
        User::observe(UserObserver::class);
    }
}
