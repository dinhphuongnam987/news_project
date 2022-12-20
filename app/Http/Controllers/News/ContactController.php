<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use App\Models\SettingModel;
use App\Models\ContactModel as MainModel;
use App\Http\Requests\ContactRequest as MainRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailContact;


class ContactController extends Controller
{
    private $pathViewController = 'news.pages.contact.';
    private $controllerName = 'contact';
    private $model;
    private $settingModel;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->settingModel = new SettingModel();
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {   
        $title = 'Liên Hệ';
        $item = $this->settingModel->getItem(['field' => 'key_value', 'field_value' => 'general-setting'], ['task' => 'get-item']);

        return view($this->pathViewController .'index', [
            'title' => $title,
            'item' => $item,
        ]);
    }

    public function save(MainRequest $request)
    {
        if($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'add-item']);
            Mail::to($params['email'])->send(new MailContact);

            return response()->json([
                'status' => 200,
                'data'   => $params
            ]);
        }
    }
}