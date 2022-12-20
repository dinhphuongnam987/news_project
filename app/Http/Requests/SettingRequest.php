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
        $condThumb      = '';
        $condHotline    = '';
        $condMail       = '';
        $condAddress    = '';
        $condStartTime  = '';
        $condEndTime    = '';
        $condPassword   = '';
        $condEmailBcc   = '';
        $condYoutube    = '';
        $condFacebook   = '';
        $condBankName   = '';
        $condAccountNumber   = '';
        $condPaymentTime   = '';
        
        $task = '';
        if(isset($this->input()['btn-general-setting'])) $task = 'general-setting';
        if(isset($this->input()['btn-email-setting'])) $task = 'email-setting';
        if(isset($this->input()['btn-social-setting'])) $task = 'social-setting';
        if(isset($this->input()['btn-bank-setting'])) $task = 'bank-setting';
        if(isset($this->input()['btn-payment-time-setting'])) $task = 'payment-time';
        
        switch($task) {
            case 'general-setting':
                $condThumb      = 'bail|required';
                $condHotline    = 'bail|required|digits:10';
                $condMail       = 'bail|required|email';
                $condAddress    = 'bail|required';
                $condStartTime  = 'bail|required';
                $condEndTime    = 'bail|required';
                break;
            case 'email-setting':
                $condMail       = 'bail|required|email';
                $condPassword   = 'bail|required';
                $condEmailBcc   = 'bail|required|email|different:email';
                break;
            case 'social-setting':
                $condYoutube    = 'bail|required|url';
                $condFacebook   = 'bail|required|url';
                break;
            case 'bank-setting':
                $condBankName    = 'bail|required';
                $condAccountNumber   = 'bail|required|numeric';
                break;
            case 'payment-time':
                $condPaymentTime   = 'bail|required';
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
            'bank_name'  => $condBankName,
            'account_number' => $condAccountNumber,
            'payment_time' => $condPaymentTime,
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
