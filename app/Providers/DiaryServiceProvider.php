<?php

namespace App\Providers;

use App\Repositories\DiaryInterface;
use Illuminate\Support\ServiceProvider;

class DiaryServiceProvider extends ServiceProvider
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
        $this->app->bind(DiaryInterface::class, 'App\Services\DiaryService');
    }
}
