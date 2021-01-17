<?php

namespace App\Repositories\Contracts;

/**
 * Interface CoinConversionRepository
 */
interface CoinConversionRepository
{
    public function create(array $attributes): bool;
}
