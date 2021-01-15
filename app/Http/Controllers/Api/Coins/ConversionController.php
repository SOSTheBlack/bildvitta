<?php

namespace App\Http\Controllers\Api\Coins;

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
     * @param ConversionRequest $conversionRequest
     *
     * @return JsonResponse
     */
    public function __invoke(ConversionRequest $conversionRequest): JsonResponse
    {
        return response()->json(['message' => 'Hello World']);
    }
}
