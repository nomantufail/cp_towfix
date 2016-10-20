<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;

class DeleteOrderRequest extends Request{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_id' => 'required|exists:orders,id'
        ];
    }

}
