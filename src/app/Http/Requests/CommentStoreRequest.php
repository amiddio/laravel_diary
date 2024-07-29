<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
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
            'content' => ['required', 'string', 'max:1000'],
            'commentable_id' => ['required', 'integer', 'exists:blog_posts,id'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'content.required' => __('Comment is required.'),
            'content.max' => __('Your comment cannot be longer than :max symbols.'),
            'commentable_id.required' => __('Post Id is required.'),
            'commentable_id.exists' => __('Post is required.'),
        ];
    }
}
