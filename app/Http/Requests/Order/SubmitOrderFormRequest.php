<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;

class SubmitOrderFormRequest extends Request{ public function authorize(){ return true; } }
