<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('cart.cart', compact('carts', 'total', 'subtotal'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'price' => $product->price_dc ?? $product->price,
            'qty' => 1,
            'weight' => 0,
            'options' => [
                'images' => $product->productImages,
            ],
        ]);

        return back();
    }
    public function update(Request $request)
    {
        if($request->ajax()){
           $data = Cart::update($request->rowId, $request->qty);
        }
        
        return response($data);
    }

    public function delete($rowId)
    {
        Cart::remove($rowId);
        return back();
    }

    public function destroy()
    {
        Cart::destroy();
        return back();
    }
}
