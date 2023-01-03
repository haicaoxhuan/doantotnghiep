<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = $this->getCartCheckout();

        //address
        $cities = City::orderBy('matp', 'asc')->get();

        return view('checkout.index', compact('carts', 'cities'));
    }

    public function address(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $respone = '';
            if ($data['action'] == "city") {
                $districts = District::where('matp', $data['map'])->orderBy('maqh', 'asc')->get();
                $respone .= '<option>-Select district-</option>';
                foreach ($districts as $key => $district) {
                    $respone .= '<option value="' . $district->maqh . '">' . $district->name_quanhuyen . '</option>';
                }
            } else {
                $wards = Wards::where('maqh', $data['map'])->orderBy('xaid', 'asc')->get();
                $respone .= '<option>-Select wards-</option>';
                foreach ($wards as $key => $ward) {
                    $respone .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            return $respone;
        }
    }

    public function addOrder(Request $request)
    {
        $custId = Auth::guard('customer')->id();
        //thêm order   
        $order = Order::create([
            'code' => substr(md5(microtime()), rand(0, 26), 5),
            'customer_id' => $custId,
            'name' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'district' => $request->district,
            'ward' => $request->wards,
            'address' => $request->address,
            // 'coupon_id' => ,
            'status' => 1,
            'total' => $request->total,
        ]);
        //chi tiết order
        $carts = $this->getCartCheckout();

        $sum = 0;
        foreach ($carts as $cart) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'product_name' => $cart->product_name,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'color' => $cart->color,
            ];

            Order_Detail::create($data);
        }
        //xóa giỏ hàng
        $clear = Customer::find($custId);
        if ($clear) {
            $clear->cart->cartDetail()->delete();
            $clear->cart()->delete();
        }
        //kết quả
        return 'Succes !!!!';
    }

    public function getCartCheckout()
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
            'products.name as product_id',
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
}
