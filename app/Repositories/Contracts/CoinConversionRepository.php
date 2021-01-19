<?php

namespace App\Repositories\Contracts;

use App\Exceptions\Repositories\QueryException;
use Illuminate\Support\Collection;

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

    /**
     * @return Collection
     *
     * @throws QueryException
     */
    public function getAll(): Collection;
}
