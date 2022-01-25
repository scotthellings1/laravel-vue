<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 *
 */
class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index()
    {
        return (new ProductCollection(Product::all()))
            ->additional(['message' => 'success']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return ProductResource
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return (new ProductResource($product))
            ->additional(['message' => 'Product Added']);
    }

    /**
     * Show the specified resource
     *
     * @param  Product  $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json(['message' => 'Product Updated!']);
    }


    /**
     * Delete the specified resource from storage
     *
     * @param  Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product Deleted!']);
    }
}
