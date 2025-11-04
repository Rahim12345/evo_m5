<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceRequest extends FormRequest
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
            'icon' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'order_no' => ['required', 'integer', 'min:0'],
            'locale' => ['required', Rule::in(array_keys(config('app.languages')))],
        ];
    }

    public function attributes(): array
    {
        return [
            'icon' => 'Icon',
            'title' => 'Title',
            'description' => 'Description',
            'order_no' => 'Order Number',
            'locale' => 'Locale',
        ];
    }
}
