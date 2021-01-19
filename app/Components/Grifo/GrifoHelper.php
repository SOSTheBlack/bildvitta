<?php

namespace App\Components\Grifo;

use App\Exceptions\Repositories\QueryException;
use App\Repositories\Contracts\CoinConversionRepository;
use Illuminate\Support\Collection;

/**
 * Trait GrifoHelper
 *
 * @package App\Components\Grifo
 */
trait  GrifoHelper
{
    /**
     * @return void
     *
     * @throws QueryException
     */
    public function loadConversionList()
    {
        $coinConversionResult = app(CoinConversionRepository::class)->getAll();

        $groupByOrigin = $coinConversionResult->groupBy('origin');

        $this->graph = $groupByOrigin->map(fn(Collection $value) => $value->pluck('price', 'destiny'))->toArray();
    }
}
