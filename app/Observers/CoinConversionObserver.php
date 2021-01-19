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

            $priceConversion = 1 / $coinConversion->price;

            $graph = ['origin' => $coinConversion->destiny, 'destiny' => $coinConversion->origin, 'price' => $priceConversion];

            $coinConversionRepository->create($graph);
        } catch (QueryException $queryException) {
        }
    }
}
