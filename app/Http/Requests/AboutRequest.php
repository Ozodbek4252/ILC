<?php

namespace App\Http\Requests;

use App\Models\Lang;
use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            $background_image = 'nullable|image|mimes:svg,jpeg,png,jpg';
            $sec1_image = 'nullable|image|mimes:svg,jpeg,png,jpg';
            $sec2_image = 'nullable|image|mimes:svg,jpeg,png,jpg';
        } else {
            $background_image = 'required|image|mimes:svg,jpeg,png,jpg';
            $sec1_image = 'required|image|mimes:svg,jpeg,png,jpg';
            $sec2_image = 'required|image|mimes:svg,jpeg,png,jpg';
        }

        $rules = [
            'background_image' => $background_image,
            'sec1_image' => $sec1_image,
            'sec2_image' => $sec2_image,
        ];

        $langs = Lang::where('is_published', true)->get();
        foreach ($langs as $lang) {
            $rules['title_' . $lang->code] = 'required|string';
            $rules['sub_title_' . $lang->code] = 'required|string';
            $rules['sec1_description_' . $lang->code] = 'required|string';
            $rules['sec2_description_' . $lang->code] = 'required|string';
        }

        return $rules;
    }
}
