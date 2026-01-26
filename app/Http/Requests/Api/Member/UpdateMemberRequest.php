<?php

namespace App\Http\Requests\Api\Member;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if (!$user) return false;

        return $user->id === (int) $this->route('id');
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
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($this->route('id')),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'digits_between:9,20'],
            'address' => ['nullable', 'string', 'max:255'],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ],
            'country_id' => ['required', 'exists:countries,id'],
        ];
    }
}
