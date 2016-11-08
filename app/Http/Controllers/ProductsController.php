<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\CartRepository;
use App\Repositories\ProductImagesRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\VehiclesRepository;
use Illuminate\Support\Facades\Auth;
use Response;

class ProductsController extends ParentController
{
    private $products = null;
    private $productImages = null;
    private $vehiclesRepo = null;
    private $cart = null;
    public function __construct(ProductsRepository $productsRepo,
                                ProductImagesRepository $productImagesRepo, VehiclesRepository $vehiclesRepository,
                                CartRepository $cartRepository
                                )
    {
        parent::__construct();
        $this->products = $productsRepo;
        $this->productImages = $productImagesRepo;
        $this->vehiclesRepo = $vehiclesRepository;
        $this->cart = $cartRepository;
    }

    public function showProducts(Requests\Product\ViewProductsRequest $request)
    {
        $products = $this->products->getWithDetails();
        if(Auth::user()->isCustomer()){
            return view('products.online-store', [
                'products'=>$products,
                'productsInCart' => $this->cart->userProductIds(Auth::user()->id)
            ]);
        }else{
            return view('products.list-products', ['products'=>$products]);
        }
    }

    public function showAddProductForm(Requests\Product\ShowAddProductFormRequest $request)
    {
        return view('products.add-product');
    }

    public function productDetail(Requests\Product\ShowProductDetailRequest $request)
    {
        return view('products.product-detail', [
            'product'=>$this->products->findFullById($request->route()->parameter('product_id')),
            'productsInCart' => $this->cart->userProductIds(Auth::user()->id)
        ]);
    }

    public function addProduct(Requests\Product\AddProductRequest $request)
    {
        try{
            $product_images = [];
                $productId = $this->products->store($request->storableAttrs())->id;
            if($request->file('images') != null) {
                foreach ($request->file('images') as $file) {
                    $public_path = '/images/products/' . $productId;
                    $destinationPath = public_path($public_path);
                    $filename = $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);
                    $product_images[] = [
                        'product_id' => $productId,
                        'path' => $public_path . '/' . $filename
                    ];
                }
                $this->productImages->insertMultiple($product_images);
            }
            return redirect()->back()->with('success','Product Added Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

    public function editProductForm(Requests\Product\ShowEditProductFormRequest $request, $product_id)
    {
        try{
            $data = [
                'product' => $this->products->findFullById($product_id)
            ];
            return view('products.edit-product', $data);
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
    public function updateProduct(Requests\Product\UpdateProductRequest $request, $product_id)
    {
        try{
            $product_images = [];
            $this->products->updateWhere(['id' => $product_id], $request->updateableAttrs());

        if($request->file('images') != null) {

            foreach ($request->file('images') as $file) {
                $public_path = '/images/products/'.$product_id;
                $destinationPath = public_path($public_path);
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $product_images[] = [
                    'product_id' => $product_id,
                    'path' => $public_path . '/'.$filename
                ];
            }
            $this->productImages->insertMultiple($product_images);
        }

            return redirect()->back()->with('success','Product Updated Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }


    public function deleteImageById(\Illuminate\Http\Request $request)
    {
        return ($this->productImages->deleteById($request->route()->parameter('image_id')))? Response::json(array('status' => 'success'), 200): Response::json(array('status' => 'success'), 200);
    }

    public function delete(Requests\Product\DeleteProductRequest $request)
    {
        try{
            $this->products->deleteById($request->route()->parameter('product_id'));
            return redirect()->back()->with('success','Product deleted successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

}
