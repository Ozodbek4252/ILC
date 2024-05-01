<?php

namespace App\Http\Requests;

use App\Models\Lang;
use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
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
        $rules = [];

        $langs = Lang::where('is_published', true)->get();
        foreach ($langs as $lang) {
            $rules['question_' . $lang->code] = 'required|string';
            $rules['answer_' . $lang->code] = 'required|string';
        }

        return $rules;
    }
}
