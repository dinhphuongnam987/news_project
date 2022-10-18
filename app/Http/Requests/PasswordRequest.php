<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordRule;

class PasswordRequest extends FormRequest
{
    private $table            = 'user';
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
            'current_password' => [
                'bail',
                'required',
                'different:password',
                new PasswordRule() 
            ],
            'password' => 'bail|required|confirmed',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
    public function attributes()
    {
        return [
        ];
    }
}
