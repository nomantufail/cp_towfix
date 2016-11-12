<?php

namespace App\Http\Requests\Manual;

use App\Http\Requests\Request;

class AddManualRequest extends Request
{
    protected $maxImages = 10;
    public function storableAttrs()
    {
        $storableAttrs = [
            'title' => $this->input('name'),
            'description' => $this->input('detail'),
        ];
        return $storableAttrs;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('add','manuals');
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
            'name'=>'required|max:190',
            'detail'=>'required'
        ];
        foreach(range(0, (count($this->file('images')) - 1)) as $index) {
            $rules['images.' . $index] = 'image|max:2000';
        }
        return $rules;
    }
}
