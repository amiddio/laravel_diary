<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiaryPostRequest extends FormRequest
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
            'category_id' => ['nullable', 'numeric'],
            'title' => ['required', 'max:150'],
            'content' => ['required'],
            'published_at' => ['required', 'date_format:Y-m-d H:i:s'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => __('Post title is required.'),
            'title.max' => __('Post title cannot be longer than :max symbols.'),
            'content.required' => __('Post content is required.'),
            'published_at.required' => __('Publish date is required.'),
            'published_at.date_format' => __('Publish date is wrong format. For example correct format: 2024-03-21 14:55:00'),
        ];
    }
}
