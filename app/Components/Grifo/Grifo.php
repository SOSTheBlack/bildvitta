<?php

namespace App\Components\Grifo;

/**
 * Interface GrifoContracts
 *
 * @method Grifo setOrigin(string $origin)
 * @method Grifo setDestiny(string $destiny)
 *
 * @package App\Components\Grifo
 */
interface Grifo
{
    /**
     * @return array
     *
     * @throws GrifoException
     */
    public function getStepListToConversion(): array;

    /**
     * @param  int  $quantity
     *
     * @return float
     */
    public function conversionPrice(int $quantity): float;
}
