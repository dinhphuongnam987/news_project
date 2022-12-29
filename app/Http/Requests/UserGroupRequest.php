<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGroupRequest extends FormRequest
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
        $task = 'default';
        if (isset($this->input()['btn-info'])) $task = 'save-info';
        if (isset($this->input()['btn-permission'])) $task = 'save-permission';

        $condName = '';
        $condPermission = '';

        switch($task) {
            case 'save-info':
                $condName = 'required';
                $condPermission = '';
                break;
            case 'save-permission':
                $condName = '';
                $condPermission ='required';
                break;
            default:
                $condName ='required';
                $condPermission = 'required';
                break;
        }

        return [
            'name' => $condName,
            'permission_ids'  => $condPermission,
        ];
    }
}
