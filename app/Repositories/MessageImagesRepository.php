<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\MessageImage;

class MessageImagesRepository extends Repository
{
    public function __construct(MessageImage $image)
    {
        $this->setModel($image);
    }
}