<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class AddProductRequest extends Request
{

    public function storableAttrs()
    {
        return [
            'name' => $this->input('name'),
            'price' => $this->input('price'),
            'detail' => $this->input('detail')
        ];
    }
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
        $rules = [
            'images'=>'max:10'
        ];
        foreach(range(0, (count($this->file('images')) - 1)) as $index) {
            $rules['images.' . $index] = 'image|max:2000';
        }
        return $rules;
    }
}
