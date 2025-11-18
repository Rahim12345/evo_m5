<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:255'],
            'order_no' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'locale' => 'Dil seçimi',
            'src' => 'Şəkil',
            'alt' => 'Alternative mətn',
            'name' => 'Ad',
            'slug' => 'Slug',
            'order_no' => 'Sıra nömrəsi',
            'category_id' => 'Kateqoriya',
        ];
    }
}
