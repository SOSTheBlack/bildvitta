<?php

namespace App\Providers;

use App\Models\CoinConversion;
use App\Observers\CoinConversionObserver;
use Illuminate\Support\ServiceProvider;

/**
 * Class ObserverServiceProvider
 *
 * @package App\Providers
 */
class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        CoinConversion::observe(CoinConversionObserver::class);
    }
}
