<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{   
    public function signuppage()
    {
        return view('admin.admin_signup');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect('admin/login');
    }
    
    public function loginpage()
    {
        return view('admin.admin_login');
    }
    
    public function login(Request $request)
    {
        $check = $request->all();
        if(Auth::guard('admin')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])){
            return redirect('admin/dashboard');
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }

    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.admin_index', compact('admin'));
    }
}
