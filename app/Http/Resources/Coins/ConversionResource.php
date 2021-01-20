<?php

namespace App\Http\Resources\Coins;

use App\Http\Requests\Api\Coins\ConversionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ConversionResource
 *
 * @package App\Http\Resources\Coins
 */
class ConversionResource extends JsonResource
{
    /**
     * @var ConversionRequest
     */
    private ConversionRequest $conversionRequest;

    /**
     * @var float
     */
    private float $priceConverted;

    /**
     * ConversionResource constructor.
     *
     * @param  ConversionRequest  $conversionRequest
     * @param  float  $priceConverted
     */
    public function __construct(ConversionRequest $conversionRequest, float $priceConverted)
    {
        $this->conversionRequest = $conversionRequest;
        $this->priceConverted = $priceConverted;

        parent::__construct($this->conversionRequest);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     *
     * @noinspection PhpMissingParamTypeInspection
     */
    public function toArray($request): array
    {
        return [
            'coin_from' => $this->conversionRequest->coin_from,
            'coin_to'   => $this->conversionRequest->coin_to,
            'quantity'  => $this->conversionRequest->quantity,
            'price'     => (float) number_format(num: $this->priceConverted, decimals: 2, thousands_separator: ''),
        ];
    }
}
