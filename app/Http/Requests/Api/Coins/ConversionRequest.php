<?php

namespace App\Http\Requests\Api\Coins;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class ConversionRequest.
 *
 * @property string coin_from
 * @property string coin_to
 * @property int quantity
 *
 * @package App\Http\Requests\Api\Coins
 */
class ConversionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['quantity' => "string[]", 'coin_to' => "string[]", 'coin_from' => "string[]"])] public function rules(): array
    {
        return [
            'quantity'  => ['required', 'numeric', 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'coin_from' => ['required', 'string', 'exists:coin_conversions,origin'],
            'coin_to'   => ['required', 'string', 'exists:coin_conversions,destiny'],
        ];
    }
}
