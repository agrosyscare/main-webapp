<?php

namespace App\Providers;

use App\Interfaces\GreenhouseSectionServiceInterface;
use App\Services\GreenhouseSectionService;
use Illuminate\Support\ServiceProvider;

class GreenhouseSectionProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GreenhouseSectionServiceInterface::class, GreenhouseSectionService::class);
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
