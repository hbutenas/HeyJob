<?php

namespace App\Http\Requests\Api\V1\Companies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'regex:/^[\pL\pN\s]+$/u', 'min:2', 'max:255'], // Regex allows numbers, spaces 
            'description' => ['string', 'regex:/^[\pL\pN\s]+$/u', 'min:2', 'max:1000'], // Regex allows numbers, spaces 
            'website_url' =>  ['string', 'url', 'max:255'],
        ];
    }
}
