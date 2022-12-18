<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    private $table            = 'product';

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

        $condName           = "bail|required|between:2,255|unique:$this->table,name";
        $condThumb          = 'bail|image|max:500';
        $condOriginalPrice  = 'required|numeric|min:1000|max:99000000';
        $condPrice          = 'required|numeric|min:1000|max:99000000';

        if(!empty($id)){
            $condName .= ",$id";
            $condOriginalPrice = 'numeric|min:1000|max:99000000';
            $condPrice = 'numeric|min:1000|max:99000000';
        }

        return [
            'name'           => $condName,
            'description'    => 'required|bail|required|min:5',
            'code'           => 'required',
            'original_price' => $condOriginalPrice,
            'price'          => $condPrice,
            'quantity'       => 'required|numeric|min:0',
            'quantity_remaining' => 'required|numeric|min:0',
            'status'         => 'required|bail|in:active,inactive',
            'thumb'          => 'bail|image'
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
