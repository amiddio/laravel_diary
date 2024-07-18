<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'name' => ['required', 'max:100',
                        Rule::unique(Category::class)
                            ->where('user_id', $this->user()->id)
                            ->ignore($this->route()->parameter('category'))
                ],
            'is_active' => ['present', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('Category name is required.'),
            'name.max' => __('Category name cannot be longer than :max symbols.'),
            'name.unique' => __('Category name must be unique'),
        ];
    }
}
