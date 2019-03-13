<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannedWordsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'banned_words' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'banned_words.required' => 'File is required',
            'banned_words.mimes'    => 'File must be an csv extension',
        ];
    }
}
