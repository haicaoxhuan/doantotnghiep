<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Http\Response;

class CounponController extends Controller
{
    public function __construct(Coupon $coupons)
    {
        $this->coupon = $coupons;
    }


    public function index(Request $request)
    {
        $coupons = Coupon::select(
            'coupons.id',
            'coupons.name',
            'coupons.started_at',
            'coupons.ended_at',
            'coupons.quantity',
            'coupons.status',
            'coupons.value',
        );
        if (isset($request->search)) {
            $coupons->where('brands.name', 'like', '%' . $request->search . '%');
        }

        $coupons = $coupons->paginate(10);
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(CouponRequest $request)
    {
        try {
            DB::beginTransaction();
            $now = Carbon::now();
            // dd($now);
            $param = [
                'name' => $request->name,
                'code' => $request->code,
                'quantity' => $request->qty,
                'value' => $request->value,
                'started_at' => isset($request->start) ? Carbon::createFromFormat('d/m/Y H:i', $request->start) : $request->start,
                'ended_at' => isset($request->end) ? Carbon::createFromFormat('d/m/Y H:i', $request->end) : $request->end,
            ];
            $this->coupon->create($param);
            DB::commit();
            return redirect()->route('admin.coupon.index')->with([
                'status_succeed' => trans('message.create_coupon_successd')
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return back()->with([
                'status_failed' => trans('message.server_error')
            ]);
        }
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(CouponRequest $request, $id )
    {
        try {
            DB::beginTransaction();
            $coupons = Coupon::find($id);
            $param = [
                'name' => $request->name,
                'code' => $request->code,
                'quantity' => $request->qty,
                'value' => $request->value,
                'started_at' => isset($request->start) ? Carbon::createFromFormat('d/m/Y H:i', $request->start) : $request->start,
                'ended_at' => isset($request->end) ? Carbon::createFromFormat('d/m/Y H:i', $request->end) : $request->end,
            ];
            $coupons= $coupons->create($param);
            DB::commit();
            return redirect()->route('admin.coupon.index')->with([
                'status_succeed' => trans('message.update_product_success')
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return back()->with([
                'status_failed' => trans('message.server_error')
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $coupon = Coupon::find($id);
            if ($coupon) {
                DB::beginTransaction();
                $coupon->delete();
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
}
