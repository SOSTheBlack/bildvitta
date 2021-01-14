<?php

namespace App\Http\Controllers\Api\Coins;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ConversionController
 *
 * @package App\Http\Controllers\APi\Coins
 */
class ConversionController  extends CoinController
{
    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(['message' => 'Hello World']);
    }
}
