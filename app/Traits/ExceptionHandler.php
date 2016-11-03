<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/7/2016
 * Time: 10:48 AM
 */

namespace App\Traits;
trait ExceptionHandler
{
    public function handleInternalServerError($message = "")
    {
        return redirect('/internal-server-error')->with('message', $message);
    }
}