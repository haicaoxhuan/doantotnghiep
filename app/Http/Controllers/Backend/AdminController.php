<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin.partials.dashboard');
        }
    }

    public function auth()
    {
        return view('admin.partials.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::guard('admin')->attempt($data)) {
            // $request->session()->regenerate();
            return redirect()->route('admin.index');
        }else{
            return back()->withErrors([
                'error' => (['message' => 'Tài khoản hoặc mật khẩu không đúng']),
            ]);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth');
    }
}
