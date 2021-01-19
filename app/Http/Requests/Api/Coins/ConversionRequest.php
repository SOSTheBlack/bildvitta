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
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[\JetBrains\PhpStorm\ArrayShape(['quantity' => "string[]", 'coin_to' => "string[]", 'coin_from' => "string[]"])] public function rules(): array
    {
        return [
            'quantity' => ['required', 'numeric', 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'coin_from' => ['required', 'string'],
            'coin_to' => ['required', 'string']
        ];
    }
}
