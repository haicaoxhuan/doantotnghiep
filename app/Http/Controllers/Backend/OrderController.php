<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use PDF;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::select(
            'orders.id',
            'orders.code',
            'orders.payments',
        );
        if (isset($request->search)) {
            $orders->where('brands.name', 'like', '%' . $request->search . '%');
        }

        $orders = $orders->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function detail($code)
    {
        $order = Order::select(
            'orders.id',
            'orders.code',
            'orders.payments',
            'orders.customer_id',
            'orders.name',
            'orders.email',
            'orders.phone',
            'orders.city',
            'orders.district',
            'orders.ward',
            'orders.address',
            'orders.coupon_id',
            'orders.payments',
            'orders.status',
            'orders.total',
            'orders.created_at',
            'orders.updated_at',
            'tinhthanh.matp',
            'tinhthanh.name_city',
            'quanhuyen.name_quanhuyen as name_district',
            'quanhuyen.maqh',
            'xaphuong.name_xaphuong as name_ward',
            'xaphuong.xaid',
            'coupons.id as couponId',
            'coupons.value',
        )
            ->leftjoin('order_details', 'order_details.order_id', 'orders.id')
            ->leftjoin('tinhthanh', 'tinhthanh.matp', 'orders.city')
            ->leftjoin('quanhuyen', 'quanhuyen.maqh', 'orders.district')
            ->leftjoin('xaphuong', 'xaphuong.xaid', 'orders.ward')
            ->leftjoin('coupons', 'coupons.id', 'orders.coupon_id')
            ->where('orders.code', $code)->first();

        $orderDetails = Order_Detail::select(
            'order_details.id',
            'order_details.order_id',
            'order_details.product_detail_id',
            'order_details.product_name',
            'order_details.price',
            'order_details.quantity',
            'order_details.color',
        )->where('order_details.order_id', $order->id)
            ->get();

        return view('admin.order.detail', compact('order', 'orderDetails'));
    }

    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                DB::beginTransaction();
                $order->delete();
                $order->orderDetails->delete();
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

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $order = Order::find($request->id);
            $order->status = $request->status;
            $order->save();
            DB::commit();
            return redirect()->back()->with([
                'status_succeed' => trans('message.update_status_successd')
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return back()->with([
                'status_failed' => trans('message.server_error')
            ]);
        }
    }

    public function pdf($code)
    {
        $order = Order::select(
            'orders.id',
            'orders.code',
            'orders.payments',
            'orders.customer_id',
            'orders.name',
            'orders.email',
            'orders.phone',
            'orders.city',
            'orders.district',
            'orders.ward',
            'orders.address',
            'orders.coupon_id',
            'orders.payments',
            'orders.status',
            'orders.total',
            'orders.created_at',
            'orders.updated_at',
            'tinhthanh.matp',
            'tinhthanh.name_city',
            'quanhuyen.name_quanhuyen as name_district',
            'quanhuyen.maqh',
            'xaphuong.name_xaphuong as name_ward',
            'xaphuong.xaid',
            'coupons.id as couponId',
            'coupons.value',
        )
            ->leftjoin('order_details', 'order_details.order_id', 'orders.id')
            ->leftjoin('tinhthanh', 'tinhthanh.matp', 'orders.city')
            ->leftjoin('quanhuyen', 'quanhuyen.maqh', 'orders.district')
            ->leftjoin('xaphuong', 'xaphuong.xaid', 'orders.ward')
            ->leftjoin('coupons', 'coupons.id', 'orders.coupon_id')
            ->where('orders.code', $code)->first();

        $orderDetails = Order_Detail::select(
            'order_details.id',
            'order_details.order_id',
            'order_details.product_detail_id',
            'order_details.product_name',
            'order_details.price',
            'order_details.quantity',
            'order_details.color',
        )->where('order_details.order_id', $order->id)
            ->get();

        $pdf = PDF::loadView('admin.order.detail', ['order' =>  $order, 'orderDetails' =>$orderDetails])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('order.pdf');
    }
}
