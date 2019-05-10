<?php

namespace App\Providers;

use App\Repositories\UserInterface;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }

    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, 'App\Services\UserService');
    }
}
