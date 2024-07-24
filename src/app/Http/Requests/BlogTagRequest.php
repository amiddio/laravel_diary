<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogTagRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:30']
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('Tag name is required.'),
            'name.max' => __('Tag name cannot be longer than :max symbols.'),
        ];
    }
}
