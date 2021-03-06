<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Session;


class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all();
        return view('shop.index', [
            'products' => $products
        ]);
    }


    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        session(['cart' => $cart]);

        return redirect()->route('product.index');
    }
}
