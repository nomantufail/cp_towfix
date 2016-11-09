<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\NewsletterImage;

class NewsletterImagesRepository extends Repository
{
    public function __construct(NewsletterImage $image)
    {
        $this->setModel($image);
    }

    public function getWithDetails()
    {
        return $this->getModel()->with('images')->get();
    }
}