<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Wards;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        //address
        $cities = City::orderBy('matp', 'asc')->get();

        return view('checkout.index', compact('carts', 'total', 'subtotal', 'cities'));
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
        //thêm order   
        $order = Order::create([
            'code' => substr(md5(microtime()), rand(0, 26), 5),
            'status' => 1,
            
        ]);
        //chi tiết order
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        foreach ($carts as $cart) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'name' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'district' => $request->district,
                'ward' => $request->wards,
                'address' => $request->address,
                'subtotal' => $subtotal,
                'total' => $total,
            ];

            Order_Detail::create($data);
        }
        //xóa giỏ hàng
        Cart::destroy();
        //kết quả
        return 'Succes !!!!';
    }
}
