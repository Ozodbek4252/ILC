<?php

namespace App\Http\Requests;

use App\Models\Lang;
use Illuminate\Foundation\Http\FormRequest;

class TariffRequest extends FormRequest
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
            'price' => 'required|string',
            'link' => 'required|string',
        ];

        $langs = Lang::where('is_published', true)->get();
        foreach ($langs as $lang) {
            $rules['delivery_time_' . $lang->code] = 'required|string';
            $rules['schedule_' . $lang->code] = 'required|string';
            $rules['unit_' . $lang->code] = 'required|string';
            $rules['name_' . $lang->code] = 'required|string';
            $rules['destination_' . $lang->code] = 'required|string';
        }

        return $rules;
    }
}
