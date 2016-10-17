<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\Product;

class ProductsRepository extends Repository
{
    public function __construct(Product $product)
    {
        $this->setModel($product);
    }

    public function getWithDetails()
    {

    }
}