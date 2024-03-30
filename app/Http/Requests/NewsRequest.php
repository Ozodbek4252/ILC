<?php

namespace App\Http\Requests;

use App\Models\Lang;
use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'image' => $image,
            'is_published' => 'nullable|in:on',
        ];

        $langs = Lang::where('is_published', true)->get();
        foreach ($langs as $lang) {
            if ($lang->code == env('LOCALE')) {
                $rules['title_' . $lang->code] = 'required|string';
                $rules['text_' . $lang->code] = 'required|string';
            } else {
                $rules['title_' . $lang->code] = 'nullable|string';
                $rules['text_' . $lang->code] = 'nullable|string';
            }
        }

        return $rules;
    }
}
