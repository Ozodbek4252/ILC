<?php

namespace App\Http\Requests;

use App\Models\Lang;
use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
        // 'video' => 'required|mimetypes:video/mp4,video/webm,video/ogg|max:10240'

        if ($this->_method == 'PUT') {
            $file = 'nullable|file|mimes:svg,jpeg,png,gif,mp4,mov,avi|max:20480';
        } else {
            $file = 'required|file|mimes:svg,jpeg,png,gif,mp4,mov,avi|max:20480';
        }

        $rules = [
            'file' => $file,
            'is_published' => 'nullable|in:on',
        ];

        $langs = Lang::where('is_published', true)->get();
        foreach ($langs as $lang) {
            if ($lang->code == env('LOCALE')) {
                $rules['title_' . $lang->code] = 'required|string';
            } else {
                $rules['title_' . $lang->code] = 'nullable|string';
            }
        }

        return $rules;
    }
}
