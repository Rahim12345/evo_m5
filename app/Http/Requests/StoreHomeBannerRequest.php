<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreHomeBannerRequest extends FormRequest
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
            'locale' => ['required', Rule::in(array_keys(config('app.languages')))],
            'src' => ['required', 'image', 'max:2048'],
            'alt' => ['required', 'max:255'],
            'main_heading' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'intro_text' => 'required|string|max:3000',
            'button_text_1' => 'required|string|max:255',
            'button_text_2' => 'required|string|max:255',
            'button_link_1' => 'required|url',
            'button_link_2' => 'required|url',
            'order_no' => 'required|int|min:0|max:1000000',
        ];
    }

    public function attributes(): array
    {
        return [
            'locale' => 'Dil',
            'src' => 'Şəkil',
            'alt' => 'Alt',
            'main_heading' => 'Əsas başlığı',
            'title' => 'Başlıq',
            'intro_text' => 'Giriş mətn',
            'button_text_1' => 'Dərslənin 1-inci düyməsi',
            'button_text_2' => 'Dərslənin 2-inci düyməsi',
            'button_link_1' => 'Dərslənin 1-inci linki',
            'button_link_2' => 'Dərslənin 2-inci linki',
            'order_no' => 'Sıralama nömrəsi',
        ];
    }

    public function messages(): array{
        return [
          'alt.required' => 'Alt adın daxil edilməlidir.',
        ];
    }
}
