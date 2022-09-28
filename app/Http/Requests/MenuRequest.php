<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TypeMenuRule;

class MenuRequest extends FormRequest
{
    private $table            = 'menu';
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
        $id = $this->id;
        $typeMenu = $this->type_menu;

        $condName  = "bail|required|max:100|unique:$this->table,name";
        $condLink      = "bail|required";

        if(!empty($id)){ // edit
            $condName  .= ",$id";
        }

        if($typeMenu !== 'link') $condLink = new TypeMenuRule();

        return [
            'name'          => $condName,
            'ordering'      => 'numeric|min:1|max:100',
            'link'          => $condLink,
            'status'        => 'bail|in:active,inactive',
            'type_menu'     => 'bail|in:link,category_article',
            'type_open'     => 'bail|in:current,new_window,new_tab',
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
