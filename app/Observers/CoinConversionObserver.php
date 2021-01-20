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
     * @var CoinConversionRepository
     */
    private CoinConversionRepository $coinConversionRepository;

    public function __construct(CoinConversionRepository $coinConversionRepository)
    {
        $this->coinConversionRepository = $coinConversionRepository;
    }

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
            $priceConversion = 1 / $coinConversion->price;

            $graph = ['origin' => $coinConversion->destiny, 'destiny' => $coinConversion->origin, 'price' => $priceConversion];

            $this->coinConversionRepository->create($graph);
        } catch (QueryException $queryException) {
        }
    }
}
