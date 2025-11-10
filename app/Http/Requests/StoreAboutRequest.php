<?php

namespace App\Http\Requests;

use App\Models\About;
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
        $rules['locale'] = ['required', 'string', 'size:2'];
        $rules['alt'] = ['required', 'string', 'max:255'];
        $rules['title'] = ['required', 'string', 'max:255'];
        $rules['description'] = ['required', 'string'];

        $about = About::where('locale', request('locale'))->first();

        if ($about) {
            $rules['src'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'];
        } else {
            $rules['src'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'];
        }

        return $rules;
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
