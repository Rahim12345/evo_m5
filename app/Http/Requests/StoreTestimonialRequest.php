<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'review' => ['required', 'string', 'max:2000'],
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
            'profession' => 'İxtisas',
            'review' => 'Rəy',
            'order_no' => 'Sıra nömrəsi',
        ];
    }
}
