<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\PetRepositoryInterface;
use App\Repositories\PetRepository;


class RepositoryServiceProvider extends ServiceProvider
{


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PetRepositoryInterface::class, PetRepository::class);
    }


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
