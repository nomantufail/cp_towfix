<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;

class ShowOrderDetailRequest extends Request
{
    public function authorize(){
        return true;
    }
}
