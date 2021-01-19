<?php

namespace App\Http\Controllers\Api\Coins;

use App\Components\Grifo\Grifo;
use App\Exceptions\Repositories\QueryException;
use App\Http\Requests\Api\Coins\ConversionRequest;
use Illuminate\Http\JsonResponse;

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
     * ConversionController constructor.
     *
     * @param  Grifo  $grifo
     */
    public function __construct(Grifo $grifo)
    {
        $this->grifo = $grifo;
    }

    /**
     * @param  ConversionRequest  $conversionRequest
     *
     * @return JsonResponse
     */
    public function __invoke(ConversionRequest $conversionRequest): JsonResponse
    {
        try {
            $this->grifo->setOrigin($conversionRequest->coin_from)->setDestiny($conversionRequest->coin_to);

            $priceConversion = $this->grifo->conversionPrice($conversionRequest->quantity);

            return response()->json([
                'from'     => $conversionRequest->coin_from,
                'to'       => $conversionRequest->coin_to,
                'quantity' => $conversionRequest->quantity,
                'price'    => floor($priceConversion * 100) / 100,
            ]);
        } catch (QueryException $queryException) {
        }
    }
}
