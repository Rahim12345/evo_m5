<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSingleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'src' => 'nullable|image',
            'alt' => 'nullable|max:200',
            'name' => 'nullable|max:200',
            'facebook' => 'nullable|url|max:200',
            'instagram' => 'nullable|url|max:200',
            'youtube' => 'nullable|url|max:200',
            'x' => 'nullable|url|max:200',
            'email' => 'nullable|email|max:200',
            'phone' => 'nullable|string|max:200',
            'address' => 'nullable|string|max:200',
        ];
    }

    public function attributes(): array
    {
        return [
            'src' => 'Şəkil',
            'alt' => 'Alt Text',
            'name' => 'Layihənin adı',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'youtube' => 'YouTube',
            'x' => 'X (Twitter)',
            'email' => 'Email',
            'phone' => 'Telefon',
            'address' => 'Ünvan',
        ];
    }
}
