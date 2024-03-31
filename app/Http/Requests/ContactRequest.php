<?php

namespace App\Http\Requests;

use App\Models\Lang;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        $rules = [
            'phone' => 'required|string',
            'email' => 'required|email',
        ];

        $langs = Lang::where('is_published', true)->get();
        foreach ($langs as $lang) {
            if ($lang->code == env('LOCALE')) {
                $rules['address_' . $lang->code] = 'required|string';
                $rules['schedule_' . $lang->code] = 'required|string';
            } else {
                $rules['address_' . $lang->code] = 'nullable|string';
                $rules['schedule_' . $lang->code] = 'nullable|string';
            }
        }

        return $rules;
    }
}
