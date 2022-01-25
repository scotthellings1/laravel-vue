<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\Quote;
use Illuminate\Http\Request;

/**
 *
 */
class QuoteItemController extends Controller
{


    /**
     * @param  Request  $request
     * @param  Quote  $quote
     * @return void
     */
    public function store(Request $request, Quote $quote)
    {
       $quote->products()->sync($request->product_id, false);
    }


    /**
     * @param  Quote  $quote
     * @return ProductCollection
     */
    public function show(Quote $quote)
    {
        $quote = $quote->products;
        return new ProductCollection($quote);
//        return $quote;
    }


    /**
     * @param  Request  $request
     * @param  Quote  $quote
     * @param  Product  $product
     * @return void
     */
    public function update(Request $request, Quote $quote, Product $product)
    {

        $quote->products()->sync([$product->id => ['qty' => $request->qty]], false );
    }


    /**
     * @param  Quote  $quote
     * @param  Product  $product
     * @return void
     */
    public function destroy(Quote $quote,Product $product)
    {
        $quote->products()->detach($product);
    }
}
