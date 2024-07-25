<?php

namespace App\Http\Requests;

use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogPostRequest extends FormRequest
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
            'title' => ['required', 'max:150',
                Rule::unique(BlogPost::class)
                    ->where('user_id', $this->user()->id)
                    ->ignore($this->route()->parameter('blog_post'))
            ],
            'intro' => ['required', 'max:250'],
            'content' => ['required'],
            'published_at' => ['required', 'date_format:Y-m-d H:i:s'],
            'is_active' => ['present', 'in:0,1'],
            'tags' => [Rule::exists(BlogTag::class, column: 'id')->where('user_id', $this->user()->id)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => __('Post title is required.'),
            'title.max' => __('Post title cannot be longer than :max symbols.'),
            'intro.required' => __('Post intro is required.'),
            'intro.max' => __('Post intro cannot be longer than :max symbols.'),
            'content.required' => __('Post content is required.'),
            'published_at.required' => __('Publish date is required.'),
            'published_at.date_format' => __('Publish date is wrong format. For example correct format: 2024-03-21 14:55:00'),
        ];
    }

}
