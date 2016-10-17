<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Vehicle\AddVehicleFormRequest;
use App\Repositories\ProductsRepository;
use App\Repositories\VehiclesRepository;
use App\Repositories\VehicleTypesRepository;

class ProductsController extends ParentController
{
    private $products = null;
    public function __construct(ProductsRepository $productsRepo)
    {
        parent::__construct();
        $this->products = $productsRepo;
    }

    public function showProducts(Requests\ViewProductsRequest $request)
    {
        return $this->products->getWithDetails();
    }
}
