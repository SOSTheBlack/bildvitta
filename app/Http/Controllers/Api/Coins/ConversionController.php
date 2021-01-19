<?php

namespace App\Http\Controllers\Api\Coins;

use App\Components\Grifo\Grifo;
use App\Http\Requests\Api\Coins\ConversionRequest;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\ArrayShape;

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

        $this->grifo->setOrigin($this->conversionRequest->coin_from)->setDestiny($this->conversionRequest->coin_to);
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $priceConversion = $this->getPriceConversion();

        $response = $this->structureResponse($priceConversion);

        return response()->json($response);
    }

    /**
     * @return float
     */
    private function getPriceConversion(): float
    {
        $priceConversion = $this->grifo->conversionPrice($this->conversionRequest->quantity);

        return floor($priceConversion * 100) / 100;
    }

    /**
     * @param  float  $priceConversion
     *
     * @return array
     */
    #[ArrayShape(['from' => "string", 'to' => "string", 'quantity' => "int", 'price' => "float"])]
    private function structureResponse(float $priceConversion): array {
        return [
            'coin_from' => $this->conversionRequest->coin_from,
            'coin_to'   => $this->conversionRequest->coin_to,
            'quantity'  => $this->conversionRequest->quantity,
            'price'     => (float) number_format(num: $priceConversion, decimals: 2, thousands_separator: ''),
        ];
    }
}
