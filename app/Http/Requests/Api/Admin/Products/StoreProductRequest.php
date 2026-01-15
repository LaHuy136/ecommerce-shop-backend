<?php

namespace App\Http\Requests\Api\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'condition' => ['required', 'in:new,sale'],
            'sale_percent' => [
                'nullable',
                'required_if:condition,sale',
                'integer',
                'min:1',
                'max:100'
            ],
            'company' => ['required', 'string'],
            'images' => [
                'required',
                'array',
                'min:1',
                'max:3'
            ],
            'images.*' => [
                'image',
                'mimes:jpg,png,jpeg',
                'max:1024'
            ],
            'description' => ['nullable', 'string']
        ];
    }
}
