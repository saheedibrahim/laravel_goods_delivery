<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\OrderDispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DispatcherController extends Controller
{   
    public function index()
    {
        $dispatcherID = Auth::guard('dispatcher')->id();
        $orderDispatchers = OrderDispatcher::with(['orders', 'users'])
                ->where('dispatcher_id', $dispatcherID)->get();
        
        return view('dispatcher.dispatcher_index', ['orderDispatchers' => $orderDispatchers]);
    }
    

    public function signuppage()
    {
        return view('dispatcher.dispatcher_signup');
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'location' => 'required',
            'lga' => 'required',
            'address' => 'required',
        ]);

        Dispatcher::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'lga' => $request->lga,
            'address' => $request->address,
            'password' => $request->password,
        ]);
        
        return redirect()->route('dispatcher.login');
    }
    
    public function loginpage()
    {
        return view('dispatcher.dispatcher_login');
    }
    
    public function login(Request $request)
    {
        if(Auth::guard('dispatcher')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])){
            return redirect()->route('dispatcher.home');
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }
    
    public function logout()
    {
        Auth::guard('dispatcher')->logout();
        return redirect('dispatcher/login');
    }
}
