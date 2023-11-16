<?php

namespace App\Http\Requests\Api\V1\Jobs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJobRequest extends FormRequest
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
            'id' => ['required', 'exists:jobs,id'],
            'title' => ['required', 'string', 'regex:/^[\pL\pN\s]+$/u', 'min:2', 'max:255'],
            'description' => ['required', 'string', 'regex:/^[\pL\pN\s\'\"]+$/u', 'min:2', 'max:1000'],
            'location' => ['required', 'string', 'regex:/^[\pL\pN\s\'\",]+$/u', 'min:2', 'max:255'],
            'category_id' => ['required', 'numeric', Rule::exists('categories', 'id')],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),  // This will merge the 'id' route parameter into the request data
        ]);
    }
}
