<?php

namespace App\Models;

use App\Models\AdminModel;
class SettingModel extends AdminModel
{
    public function __construct() {
        $this->table               = 'setting';
        $this->folderUpload        = 'setting' ; 
        $this->crudNotAccepted     = ['_token','id', 'thumb_current'];
    }

    public function getItem($params = null, $options = null) { 
        $result = null;
        
        if($options['task'] == 'get-item') {
            $result = self::select('value')->where($params['field'], $params['field_value'])->first()->toArray();
            $result = json_decode($result['value'], TRUE);
        }

        if($options['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null) { 
        
        $task = $options['task'];
        $key_value = '';

        switch($task) {
            case 'update-general-setting':
                if(!empty($params['thumb'])){
                    $this->deleteThumb($params['thumb_current']);
                    $params['thumb'] = $this->uploadThumb($params['thumb']);
                } else {
                    $params['thumb'] = $params['thumb_current'];
                }
                $key_value = 'general-setting';
                break;
            case 'update-email-setting':
                $key_value = 'email-setting';
                break;
            case 'update-social-setting':
                $key_value = 'social-setting';
                break;
            case 'update-bank-setting':
                $key_value = 'bank-setting';
                break;
            case 'update-payment-time-setting':
                $key_value = 'payment-time-setting';
                break;
        }

        $params['modified_by']   = "hailan";
        $params['modified']      = date('Y-m-d');
        $params = json_encode($this->prepareParams($params));
        self::where('key_value', $key_value)->update(['value' => $params]);
    }
}

