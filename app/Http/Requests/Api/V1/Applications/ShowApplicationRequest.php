<?php

namespace App\Http\Requests\Api\V1\Applications;

use Illuminate\Foundation\Http\FormRequest;

class ShowApplicationRequest extends FormRequest
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
            'id' => ['required', 'exists:applications,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),  // This will merge the 'id' route parameter into the request data
        ]);
    }
}
