<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
        if(isset($request->search)){
            $coupons->where('brands.name', 'like', '%' . $request->search . '%');
        }

        $coupons = $coupons->paginate(10);
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        
        // dd($request->all());
        try {
            DB::beginTransaction();
            $param = [
                'name' => $request->name,
                'code' => $request->code,
                'quantity' => $request->qty,
                'value' => $request->value,
                'started_at' => isset($request->start) ? Carbon::createFromFormat('d/m/Y H:i', $request->start) : $request->start,
                'ended_at' => isset($request->end) ? Carbon::createFromFormat('d/m/Y H:i', $request->end) : $request->end,
            ];
            $this->coupon->create($param);
            dd($param);
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
}
