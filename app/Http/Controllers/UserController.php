<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDispatcher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signuppage()
    {
        return view('user.user_signup');
    }

    public function home()
    {
        $user = Auth::guard('web')->user();
        $user_id = Auth::guard('web')->id();
        $orderDispatchers = OrderDispatcher::with(['orders', 'dispatchers'])->where('user_id', $user_id)->get();

        return view('user.user_index', ['user' => $user, 'orderDispatchers' => $orderDispatchers]);
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'location' => 'required',
            'lga' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed',
        ]);

        $check_email = User::where('email', $request->email)->first();
        if($check_email){
            return back()->with('error', 'Email already in use');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'lga' => $request->lga,
            'address' => $request->address,
            'password' => $request->password,
        ]);
        
        return redirect()->route('user.login')->with('success', 'User signup successfully');
    }
    
    public function loginpage()
    {
        return view('user.user_login');
    }
    
    public function login(Request $request)
    {
        $check = $request->all();
        if(Auth::guard('web')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])){
            return redirect()->route('user.home');
        } else {
            return back()->with(['error' =>'Invalid email or password']);
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login');
    }
}
