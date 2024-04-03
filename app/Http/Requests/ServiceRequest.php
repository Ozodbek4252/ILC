<?php

namespace App\Http\Requests;

use App\Models\Lang;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'icon_id' => 'required|exists:icons,id',
            'secondary_icon_id' => 'required|exists:icons,id',
            'link' => 'required|string'
        ];

        $langs = Lang::where('is_published', true)->get();
        foreach ($langs as $lang) {
            if ($lang->code == env('LOCALE')) {
                $rules['name_' . $lang->code] = 'required|string';
                $rules['description_' . $lang->code] = 'required|string';
            } else {
                $rules['name_' . $lang->code] = 'nullable|string';
                $rules['description_' . $lang->code] = 'nullable|string';
            }
        }

        return $rules;
    }
}
