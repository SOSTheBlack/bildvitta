<?php

namespace App\Providers;

use App\Repositories\CoinConversionEloquent;
use App\Repositories\Contracts\CoinConversionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;


/**
 * Class RepositoryServiceProvider
 *
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CoinConversionRepository::class, CoinConversionEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
