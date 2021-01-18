<?php

namespace App\Observers;

use App\Exceptions\Repositories\QueryException;
use App\Models\CoinConversion;
use App\Repositories\Contracts\CoinConversionRepository;

/**
 * Class CoinConversionObserver
 *
 * @package App\Observers
 */
class CoinConversionObserver
{
    /**
     * Handle the CoinConversion "created" event.
     *
     * @param  CoinConversion  $coinConversion
     *
     * @return void
     */
    public function created(CoinConversion $coinConversion)
    {
        try {
            $coinConversionRepository = app(CoinConversionRepository::class);

            $graph = ['origin' => $coinConversion->destiny, 'destiny' => $coinConversion->origin, 'price' => 1 / $coinConversion->price];

            $coinConversionRepository->create($graph);
        } catch (QueryException $queryException) {
        }
    }
}
