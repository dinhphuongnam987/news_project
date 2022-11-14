<?php

namespace App\Providers;

use App\Models\SettingModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('setting')) {
            $model = new SettingModel();
            $mail = $model->getItem(['field' => 'key_value', 'field_value' => 'email-setting'], ['task' => 'get-item']);
            
            if($mail) {
                $data = [
                    'driver' => 'smtp',
                    'host' => 'smtp.gmail.com',
                    'port' => 587,
                    'encryption' => 'tls',
                    'username' => $mail['email'],
                    'password' => $mail['password'],
                    'from' => [
                        'address' => $mail['email'],
                        'name'  => 'news.vn'
                    ]
                ];
                Config::set('mail', $data);
            }
        }
    }
}
