<?php

namespace App\Http\Controllers;

use App\Models\DeclinedGoods;
use App\Models\DispatcherNotification;
use App\Models\Dispatcher;
use App\Models\DispatcherDecline;
use App\Models\OrderDispatcher;
use App\Models\User;
use Illuminate\Http\Request;

class DispatcherNotificationController extends Controller
{   
     public function getAnotherDispatcher(Request $request, $orderId, $dispatcherId, $userId)
     {
        $dispatcherDecline = DispatcherDecline::create([
            'order_id' => $orderId,
            'user_id' => $userId,
            'dispatcher_id' => $dispatcherId,
            'declined' => true,
        ]);

        if($dispatcherDecline){
            $dispatcherDeclineIds = DispatcherDecline::where('order_id', $orderId)->where('declined', true)->pluck('dispatcher_id');
            $user = User::find($userId);
            $dispatcher = Dispatcher::whereNotIn('id', $dispatcherDeclineIds)->where('is_available', true)->where('location', $user->location)->where('lga', $user->lga)->first();
            if($dispatcher){
                OrderDispatcher::where('order_id', $orderId)->update([
                    'dispatcher_id' => $dispatcher->id,
                ]);

                Dispatcher::where('id', $dispatcherId)->update(['is_available' => true,]);

            } else {
                OrderDispatcher::where('order_id', $orderId)->delete();
                DeclinedGoods::create([
                    'user_id' => $userId,
                    'order_id' => $orderId,
                ]);
            }
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
