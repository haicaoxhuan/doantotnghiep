<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart as ModelsCart;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
// use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    private $carts;

    public function __construct(Cart $carts)
    {
        $this->cart = $carts;
    }

    public function index()
    {
        $custId = Auth::guard('customer')->id();
        $carts = Cart::select(
            'cart.*',
            'cart_detail.id as cartDetailId',
            'cart_detail.cart_id',
            'cart_detail.product_id',
            'cart_detail.quantity',
            'cart_detail.price',
            'cart_detail.images',
            'products.name as product_name',
            'customers.id as customerId',
        )
            ->leftjoin('cart_detail', 'cart.id', 'cart_detail.cart_id')
            ->leftjoin('products', 'products.id', 'cart_detail.product_id')
            ->leftjoin('customers', 'customers.id', 'cart.customer_id')
            ->where('customers.id', $custId)
            ->get();

        return view('cart.cart', compact('carts'));
    }

    public function add(Request $request)
    {
        try {
            if ($request->ajax()) {
                DB::beginTransaction();
                $custId = Auth::guard('customer')->id();

                $cart = Cart::select(
                    'cart.*',
                    'cart_detail.product_id',
                    'cart_detail.id as cartDetailId',
                    'cart_detail.quantity',
                )->leftjoin('cart_detail', 'cart.id', 'cart_detail.cart_id')
                    ->where('cart.customer_id', $custId)->get();

                if (count($cart) != 0) {
                    foreach ($cart as $item) {
                        if ($item->product_id == $request->id) {
                            $cartDetail = CartDetail::find($item->cartDetailId);
                            $cartDetail->quantity = $item->quantity + 1;
                            $cartDetail->subtotal = $cartDetail->price * $cartDetail->quantity;
                            $cartDetail->save();
                        }
                    }
                    if ($item->product_id != $request->id) {
                        $cartDetail = new CartDetail;
                        $cartDetail->cart_id = $item->id;
                        $cartDetail->product_id = $request->id;
                        $cartDetail->price = $request->price_dc ?? $request->price;
                        $cartDetail->quantity = $request->quantity ?? 1;
                        $cartDetail->images = $request->images;
                        $cartDetail->subtotal = $cartDetail->price * $cartDetail->quantity;
                        $cartDetail->save();
                    }
                } else {

                    $param = ['customer_id' => $custId];
                    $newCart = $this->cart->create($param);

                    $cartDetail = new CartDetail;
                    $cartDetail->cart_id = $newCart->id;
                    $cartDetail->product_id = $request->id;
                    $cartDetail->price = $request->price_dc ?? $request->price;
                    $cartDetail->quantity = $request->quantity ?? 1;
                    $cartDetail->images = $request->images;
                    $cartDetail->subtotal = $cartDetail->price * $cartDetail->quantity;
                    $cartDetail->save();
                }

                DB::commit();
                return [
                    'status' => Response::HTTP_OK,
                    'msg' => [
                        'text' => trans('message.success'),
                    ],
                ];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("File: " . $e->getFile() . '---Line: ' . $e->getLine() . "---Message: " . $e->getMessage());
            return response()->json([
                'code' => \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => trans('message.server_error')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $item = CartDetail::find($id);
            if ($item) {
                DB::beginTransaction();
                $item->delete();
                DB::commit();
                return redirect()->back()->with([
                    'status_succeed' => trans('message.delete_item_cart_successd')
                ]);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return back()->with([
                'status_failed' => trans('message.server_error')
            ]);
        }
    }

    public function destroy()
    {
        try {
            $custId = Auth::guard('customer')->id();
            $clear = Customer::find($custId);
            if ($clear) {
                $clear->cart->cartDetail()->delete();
                $clear->cart()->delete();
                DB::commit();
                return redirect()->back()->with([
                    'status_succeed' => trans('message.clear_cart_successd')
                ]);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return back()->with([
                'status_failed' => trans('message.server_error')
            ]);
        }
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $proCart = CartDetail::find($request->id);
            $param = [
                'quantity' => $request->qty,
                'subtotal' => $request->price * $request->qty,
            ];
            $proCart->update($param);
            $quantity = $proCart->quantity;
            $subtotal = $proCart->subtotal;
        }

        return response()->json(['quantity' => $quantity, 'subtotal'=> $subtotal]);
    }
}
