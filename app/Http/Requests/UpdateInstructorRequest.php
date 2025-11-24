<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInstructorRequest extends FormRequest
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
            'src' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'alt' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'facebook' => ['required', 'string', 'max:255'],
            'instagram' => ['required', 'string', 'max:255'],
            'x' => ['required', 'string', 'max:255'],
            'order_no' => ['required', 'integer', 'min:0']
        ];
    }

    public function attributes(): array
    {
        return [
            'locale' => 'Dil seçimi',
            'src' => 'Şəkil',
            'alt' => 'Alternative mətn',
            'name' => 'Ad',
            'facebook' => 'Facebook',
            'instagram' => 'İnstagram',
            'x' => 'X',
            'order_no' => 'Sıra nömrəsi',
        ];
    }
}
