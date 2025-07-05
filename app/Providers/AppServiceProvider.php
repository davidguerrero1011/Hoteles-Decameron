<?php

namespace App\Providers;

use App\Interfaces\Hotels\HotelInterface;
use App\Repositories\Hotels\HotelRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HotelInterface::class, HotelRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
