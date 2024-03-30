<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IconRequest extends FormRequest
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
        if ($this->_method == 'PUT') {
            $icon = 'nullable|image|mimes:jpeg,png,jpg';
        } else {
            $icon = 'required|image|mimes:jpeg,png,jpg';
        }

        return [
            'name' => 'nullable|string',
            'icon' => $icon,
        ];
    }
}
