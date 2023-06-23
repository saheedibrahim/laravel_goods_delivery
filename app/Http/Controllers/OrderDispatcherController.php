<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\OrderDispatcher;
use App\Models\User;
use Illuminate\Http\Request;

class OrderDispatcherController extends Controller
{   
     public function getAnotherDispatcher(Request $request, $orderId, $dispatcherId, $userId)
     {
        $dispatcherDecline = OrderDispatcher::where('order_id', $orderId)->where('dispatcher_id', $dispatcherId)->update(['status' => 'Declined']);

        if($dispatcherDecline){
            $dispatcherDeclineIds = OrderDispatcher::where('order_id', $orderId)->where('status', 'Declined')->pluck('dispatcher_id');
            $user = User::find($userId);
            $dispatcher = Dispatcher::whereNotIn('id', $dispatcherDeclineIds)->where('is_available', true)->where('location', $user->location)->where('lga', $user->lga)->first();
            if($dispatcher){
                $dispatcherDecline = OrderDispatcher::create([
                    'order_id' => $orderId,
                    'user_id' => $userId,
                    'dispatcher_id' => $dispatcher->id,
                ]);
            } else {
                OrderDispatcher::create([
                    'user_id' => $userId,
                    'order_id' => $orderId,
                    'dispatcher_id' => 0,
                    'status' => 'Declined',
                ]);
            }
            
            Dispatcher::where('id', $dispatcherId)->update(['is_available' => true,]);
        }

         return redirect()->route('dispatcher.home');
     }

    public function dispatcherAccepted(Request $request, $orderId)
    {
        OrderDispatcher::where('order_id', $orderId)->update([
            'accepted' => true,
        ]);

        return redirect()->route('dispatcher.home');
    }
    
    public function goodsDelivered(Request $request, $orderId, $dispatcherId)
    {
        OrderDispatcher::where('order_id', $orderId)->update([
            'delivered' => true,
        ]);
        
        Dispatcher::where('id', $dispatcherId)->update([
            'is_available' => true,
        ]);

        return redirect()->route('dispatcher.home');
    }
  }
