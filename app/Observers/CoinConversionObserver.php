<?php

namespace App\Observers;

use App\Models\CoinConversion;
use App\Repositories\Contracts\CoinConversionRepository;
use Illuminate\Database\QueryException;

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
        } catch (\App\Exceptions\Repositories\QueryException $queryException) {

        }
    }
}
