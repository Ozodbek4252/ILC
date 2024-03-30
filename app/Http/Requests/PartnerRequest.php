<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            $image = 'nullable|image|mimes:jpeg,png,jpg';
        } else {
            $image = 'required|image|mimes:jpeg,png,jpg';
        }

        $rules = [
            'name' => 'nullable|string',
            'image' => $image
        ];

        return $rules;
    }
}
