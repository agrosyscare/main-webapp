<?php

namespace App\Providers;

use App\Interfaces\ConditionServiceInterface;
use App\Services\ConditionService;
use Illuminate\Support\ServiceProvider;

class ConditionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConditionServiceInterface::class, ConditionService::class );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
