<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\User\Repositories\EloquentUserRepository;

class RepositoryInterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Services\User\Repositories\UserRepositoryInterface::class,
            function () {
                return new EloquentUserRepository();
            }
        );

        $this->app->bind(
            \App\Services\Document\Repositories\DocumentRepositoryInterface::class,
            function () {
                return new \App\Services\Document\Repositories\EloquentDocumentRepository(
                    new EloquentUserRepository()
                );
            }
        );
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