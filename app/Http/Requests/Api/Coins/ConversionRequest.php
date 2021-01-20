<?php

namespace App\Http\Requests\Api\Coins;

use Illuminate\Foundation\Http\FormRequest;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'quantity'  => ['required', 'numeric', 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'coin_from' => ['required', 'string', 'exists:\App\Models\CoinConversion,origin'],
            'coin_to'   => ['required', 'string', 'exists:\App\Models\CoinConversion,destiny'],
        ];
    }
}
