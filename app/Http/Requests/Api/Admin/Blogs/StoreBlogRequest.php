<?php

namespace App\Http\Requests\Api\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'unique:blogs,title'
            ],
            'slug' => [
                'required',
                'string',
                'unique:blogs,slug'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg'
            ],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
        ];
    }
}
