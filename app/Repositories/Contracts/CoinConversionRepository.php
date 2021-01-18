<?php

namespace App\Repositories\Contracts;

use App\Exceptions\Repositories\QueryException;

/**
 * Interface CoinConversionRepository
 */
interface CoinConversionRepository
{
    /**
     * @param  array  $attributes
     *
     * @return bool always returns true.
     *
     * @throws QueryException
     */
    public function create(array $attributes): bool;
}
