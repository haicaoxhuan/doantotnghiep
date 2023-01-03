<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart as ModelsCart;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function __construct(Cart $carts)
    {
        $this->cart = $carts;
    }

    public function index()
    {
        $custId = Auth::guard('customer')->id();
        $carts = Cart::select(
            'cart.id',
            'cart.customer_id',
            'cart_detail.id as cartDetailId',
            'cart_detail.cart_id',
            'cart_detail.product_detail_id',
            'cart_detail.quantity',
            'cart_detail.price',
            'cart_detail.images',
            'cart_detail.color',
            'cart_detail.deleted_at',
            'products.name as product_name',
            'customers.id as customerId',
        )
            ->leftjoin('cart_detail', 'cart.id', 'cart_detail.cart_id')
            ->leftjoin('customers', 'customers.id', 'cart.customer_id')
            ->leftjoin('product_details', 'product_details.id', 'cart_detail.product_detail_id')
            ->leftjoin('products', 'products.id', 'product_details.product_id')
            ->where('customers.id', $custId)
            ->where('cart_detail.deleted_at', null)
            ->get();

        return view('cart.cart', compact('carts'));
    }

    public function getCart()
    {
        $custId = Auth::guard('customer')->id();
        $carts = Cart::select(
            'cart.id',
            'cart.customer_id',
            'cart_detail.id as cartDetailId',
            'cart_detail.cart_id',
            'cart_detail.product_detail_id',
            'cart_detail.quantity',
            'cart_detail.price',
            'cart_detail.images',
            'cart_detail.color',
            'cart_detail.deleted_at',
            'products.name as product_name',
            'customers.id as customerId',
        )
            ->leftjoin('cart_detail', 'cart.id', 'cart_detail.cart_id')
            ->leftjoin('customers', 'customers.id', 'cart.customer_id')
            ->leftjoin('product_details', 'product_details.id', 'cart_detail.product_detail_id')
            ->leftjoin('products', 'products.id', 'product_details.product_id')
            ->where('customers.id', $custId)
            ->where('cart_detail.deleted_at', null)
            ->get();

        return $carts;
    }

    public function add(Request $request)
    {
        try {
            if ($request->ajax()) {
                DB::beginTransaction();
                $custId = Auth::guard('customer')->id();
                $cart = Cart::select('cart.id')->where('cart.customer_id', $custId)->first();
                if ($cart) {
                    $cartDetail = CartDetail::where('cart_id', $cart->id)->where('product_detail_id', $request->id)->first();
                    if ($cartDetail) {
                        $cartDetail->quantity = $cartDetail->quantity + $request->quantity;
                        $cartDetail->save();
                    } else {
                        $cartDetail = new CartDetail;
                        $cartDetail->cart_id = $cart->id;
                        $cartDetail->product_detail_id = $request->id;
                        $cartDetail->price = $request->price_dc ?? $request->price;
                        $cartDetail->quantity = $request->quantity;
                        $cartDetail->images = $request->images;
                        $cartDetail->color = $request->color;
                        $cartDetail->save();
                    }
                } else {
                    $param = ['customer_id' => $custId];
                    $newCart = $this->cart->create($param);

                    $cartDetail = new CartDetail;
                    $cartDetail->cart_id = $newCart->id;
                    $cartDetail->product_detail_id = $request->id;
                    $cartDetail->price = $request->price_dc ?? $request->price;
                    $cartDetail->quantity = $request->quantity;
                    $cartDetail->images = $request->images;
                    $cartDetail->color = $request->color;
                    $cartDetail->save();
                }
                $cartUpdate = $this->getCart();
                $html = view('partials.mini-cart')->render();
                DB::commit();
                return [
                    'status' => Response::HTTP_OK,
                    'msg' => [
                        'text' => trans('message.success'),
                    ],
                    'html' => $html,
                    'data' => $cartUpdate
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

        return response()->json(['quantity' => $quantity, 'subtotal' => $subtotal]);
    }

    public function coupon(Request $request)
    {
        if ($request->ajax()) {
            $now = Carbon::now();
            $coupon = Coupon::where('coupons.code', $request->coupon)->first();
            if ($coupon) {
                if ($coupon->ended_at && $coupon->started_at < $now) {
                    $data = $coupon->value;
                    return response()->json(['data' => $data, 'status' => Response::HTTP_OK,]);
                }
            }
        }
        return [
            'status' => Response::HTTP_NOT_FOUND,
            'msg' => [
                'text' => trans('message.no_coupon'),
            ],
        ];
    }
}
