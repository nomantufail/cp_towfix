<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\ProductImagesRepository;
use App\Repositories\ProductsRepository;

class ProductsController extends ParentController
{
    private $products = null;
    private $productImages = null;
    public function __construct(ProductsRepository $productsRepo, ProductImagesRepository $productImagesRepo)
    {
        parent::__construct();
        $this->products = $productsRepo;
        $this->productImages = $productImagesRepo;
    }

    public function showProducts(Requests\Product\ViewProductsRequest $request)
    {
        $products = $this->products->getWithDetails();
        if($request->user()->isCustomer()){
            return view('products.online-store', ['products'=>$products]);
        }else{
            return view('products.list-products', ['products'=>$products]);
        }
    }

    public function showAddProductForm(Requests\Product\AddProductRequest $request)
    {
        return view('products.add-product');
    }

    public function productDetail(Requests\Product\ShowProductDetailRequest $request)
    {
        return view('products.product-detail', ['product'=>$this->products->findFullById($request->route()->parameter('product_id'))]);
    }

    public function addProduct(Requests\Product\AddProductRequest $request)
    {
        try{
            $product_images = [];
            $productId = $this->products->store($request->storableAttrs())->id;
            foreach($request->file('images') as $file)
            {
                $public_path = '/images/products/'.$productId;
                $destinationPath = public_path($public_path);
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $product_images[]=[
                    'product_id' => $productId,
                    'path' => $public_path.'/'.$filename
                ];
            }
            $this->productImages->insertMultiple($product_images);
            return redirect()->back()->with('success','Product Added Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
}
