<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Request;

class UserRequest extends FormRequest
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
        $userId = Request::instance()->id;
        return [
            'name'     => 'required',
            'email'    => [
                'required',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => Rule::requiredIf(function () {
                return Request::isMethod('POST');
            })
        ];
    }
}
