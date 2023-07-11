<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\Order;
use App\Models\OrderDispatcher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orderpage()
    {
        return view('order.user_order');
    }

    public function order(Request $request)
    {      
         $request->validate([
            'destination' => 'required',
            'lga' => 'required',
            'address' => 'required',
            'weight' => 'required',
        ]);

        $order = new Order();
        $order->user_id = Auth::guard('web')->id();
        $orderID = rand(900000, 999999);
        $checkOrderID = Order::where('orderID', $orderID);
        $order->orderID = $checkOrderID ? rand(900000, 999999) : $orderID;
        $order->destination = $request->destination;
        $order->lga = $request->lga;
        $order->address = $request->address;
        $order->weight = $request->weight;
        $order->amount = $request->destination == 'lagos' ?
                $request->weight * 1000 : $request->weight * 1000 + 5000;

        $order->save();

        $user = Auth::user();
        $dispatcher = Dispatcher::where([
            'is_available'=> true,
            'location'=> $user->location,
            'lga'=> $user->lga,
            ])->first();
        
        OrderDispatcher::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'dispatcher_id' => $dispatcher ? $dispatcher->id : 0,
            'status' => $dispatcher ? 'Pending' : 'Declined',
        ]);

        if($dispatcher){               
                        Dispatcher::where('id', $dispatcher->id)
                                    ->update(['is_available' => false]);
        }

        return redirect()->route('user.home');
    }
}
