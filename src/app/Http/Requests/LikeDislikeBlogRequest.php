<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LikeDislikeBlogRequest extends FormRequest
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
     * @return array<string, array<string>
     */
    public function rules(): array
    {
        return [
            'model_id' => ['required', 'integer', 'exists:App\Models\BlogPost,id'],
            'model_type' => ['required', 'string', 'in:blog_likedislike'],
            'like' => ['required', 'integer', 'in:0,1'],
            'dislike' => ['required', 'integer', 'in:0,1'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'model_id.exists' => __('Post is required.'),
        ];
    }
}
