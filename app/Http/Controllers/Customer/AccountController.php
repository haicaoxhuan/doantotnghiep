<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $customer = Customer::find(Auth::guard('customer')->id());
        return view('customer.account.index', compact('customer'));
    }
}
