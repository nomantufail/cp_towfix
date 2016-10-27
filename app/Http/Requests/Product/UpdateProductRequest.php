<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class UpdateProductRequest extends Request
{
    protected $maxImages = 10;
    public function updateableAttrs()
    {
        $storableAttrs = [
            'name' => $this->input('name'),
            'detail' => $this->input('detail'),


        ];
        // dd($this->input('contact_poster'));


        if($this->input('contact_poster') == 1){
            $storableAttrs['contact'] = $this->input('contact');
            $storableAttrs['email'] = $this->input('email');
            $storableAttrs['address'] = $this->input('address');
            $storableAttrs['is_poster'] = $this->input('contact_poster');

        }else{
            $storableAttrs['price'] = $this->input('price');
        }

        return $storableAttrs;
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

    public function messages()
    {
        return [
            'images.max'=>'Images should not be greater than '.$this->maxImages
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'images'=>'max:'.$this->maxImages,
            'name'=>'required',
            'detail'=>'required'
        ];

        if($this->input('contact_poster') == 1)
        {

            $rules['contact'] = 'required';
            $rules['email'] = 'required|email';
            $rules['address'] = 'required';
        }
        else{

            $rules['price'] = 'required';
        }

        foreach(range(0, (count($this->file('images')) - 1)) as $index) {
            $rules['images.' . $index] = 'image|max:2000';
        }
        return $rules;
    }
}
