<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\Newsletter;

class NewslettersRepository extends Repository
{
    public function __construct(Newsletter $newsletter)
    {
        $this->setModel($newsletter);
    }
}