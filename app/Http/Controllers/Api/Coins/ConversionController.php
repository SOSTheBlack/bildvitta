<?php

namespace App\Http\Controllers\Api\Coins;

use App\Components\Grifo\Grifo;
use App\Http\Requests\Api\Coins\ConversionRequest;
use App\Http\Resources\Coins\ConversionResource;

/**
 * Class ConversionController
 *
 * @package App\Http\Controllers\APi\Coins
 */
class ConversionController extends CoinController
{
    /**
     * Grifo Component.
     *
     * @var Grifo
     */
    private Grifo $grifo;

    /**
     * @var ConversionRequest
     */
    private ConversionRequest $conversionRequest;

    /**
     * ConversionController constructor.
     *
     * @param  Grifo  $grifo
     * @param  ConversionRequest  $conversionRequest
     */
    public function __construct(ConversionRequest $conversionRequest, Grifo $grifo)
    {
        $this->grifo = $grifo;
        $this->conversionRequest = $conversionRequest;
    }

    /**
     * @return ConversionResource
     */
    public function __invoke(): ConversionResource
    {
        $this->grifo
            ->setOrigin($this->conversionRequest->coin_from)
            ->setDestiny($this->conversionRequest->coin_to);

        $priceConverted = $this->priceConverted();

        return new ConversionResource($this->conversionRequest, $priceConverted);
    }

    /**
     * @return float
     */
    private function priceConverted(): float
    {
        $quantity = $this->conversionRequest->quantity;

        $priceConversion = $this->grifo->conversionPrice($quantity);

        return floor($priceConversion * 100) / 100;
    }
}
