<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.partials.dashboard');
    }
    public function auth()
    {
        return view('admin.partials.login');
    }
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($data)){
            return redirect(route('admin.index'));
        }else{
            return redirect(route('admin.auth'));
        }
        
    }
}
