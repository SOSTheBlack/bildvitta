<?php

namespace App\Http\Controllers\Api\Coins;

use App\Component\Grifo\GrifoComponent;
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
     * @param  ConversionRequest  $conversionRequest
     *
     * @return JsonResponse
     */
    public function __invoke(ConversionRequest $conversionRequest): JsonResponse
    {
        try {
            $coinConversionComponent = new GrifoComponent();
            $coinConversionComponent->loadConversionList();
            $coinConversionComponent
                ->setOrigin($conversionRequest->coin_from)
                ->setDestiny($conversionRequest->coin_to)
                ->setQuantity($conversionRequest->quantity);

            $priceConversion = $coinConversionComponent->getConversionPrice();

            return response()->json([
                'from' => $conversionRequest->coin_from,
                'to' => $conversionRequest->coin_to,
                'quantity' => $conversionRequest->quantity,
                'price' => $priceConversion
            ]);
        } catch (QueryException $queryException) {
        }
    }
}
