<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    private $table            = 'setting';
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
        $condThumb      = 'bail|required';
        $condHotline    = 'bail|required|digits:10';
        $condMail       = 'bail|required|email';
        $condAddress    = 'bail|required';
        $condStartTime  = 'bail|required';
        $condEndTime    = 'bail|required';
        $condPassword   = '';
        $condEmailBcc   = '';
        $condYoutube    = '';
        $condFacebook   = '';
        
        $task = '';
        if(isset($this->input()['btn-email-setting'])) $task = 'email-setting';
        if(isset($this->input()['btn-social-setting'])) $task = 'social-setting';
        
        switch($task) {
            case 'email-setting':
                $condThumb      = '';
                $condHotline    = '';
                $condAddress    = '';
                $condStartTime  = '';
                $condEndTime    = '';
                $condPassword   = 'bail|required';
                $condEmailBcc   = 'bail|required|email|different:email';
                break;
            case 'social-setting':
                $condThumb      = '';
                $condHotline    = '';
                $condMail       = '';
                $condAddress    = '';
                $condStartTime  = '';
                $condEndTime    = '';
                $condYoutube    = 'bail|required|url';
                $condFacebook   = 'bail|required|url';
                break;
            }
            
        $condThumb = !empty($this->thumb_current) ? '' : $condThumb;

        return [
            'thumb'      => $condThumb,
            'hotline'    => $condHotline,
            'email'      => $condMail,
            'address'    => $condAddress,
            'start_time' => $condStartTime,
            'end_time'   => $condEndTime,
            'password'   => $condPassword,
            'email_bcc'  => $condEmailBcc,
            'youtube'    => $condYoutube,
            'facebook'   => $condFacebook,
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
