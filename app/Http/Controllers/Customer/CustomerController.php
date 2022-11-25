<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function __construct(Customer $customers)
    {
        $this->customer = $customers;
    }

    public function auth()
    {
        return view('customer.partials.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::guard('customer')->attempt($data)) {
            return redirect()->route('home');
        }else{
            return back()->withErrors([
                'error' => (['message' => 'Tài khoản hoặc mật khẩu không đúng']),
            ]);
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.auth');
    }

    public function register(Request $request)
    {
        try{
            DB::beginTransaction();
            $param = [
                'name' => $request->cusname,
                'email' => $request->cusemail,
                'password' => Hash::make($request->cuspassword)
            ];
            $this->customer->create($param);
            DB::commit();
            return redirect()->route('customer.registersucces')->with([
                'status_succeed' => trans('message.create_customer_successd')
            ]);
        }catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return back()->with([
                'status_failed' => trans('message.create_customer_failed')
            ]);
        }
    }
    public function registersucces()
    {
        return view('customer.partials.registersucces');
    }

}
