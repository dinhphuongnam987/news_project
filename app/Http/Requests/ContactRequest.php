<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'bail|required',
            'email' => 'bail|required|email',
            'phone' => 'bail|required|digits:10',
            'message' => 'bail|required'
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
