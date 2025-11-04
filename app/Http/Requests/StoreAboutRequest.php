<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAboutRequest extends FormRequest
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
            'locale' => ['required', 'string', 'size:2'],
            'src' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'alt' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'locale' => 'Dil seçin',
            'src' => 'Image source',
            'alt' => 'Image Alt Text',
            'title' => 'Başlıq',
            'description' => 'Mətn',
        ];
    }
}
