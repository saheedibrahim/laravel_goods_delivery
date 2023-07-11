<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\OrderDispatcher;
use App\Models\User;

class OrderDispatcherController extends Controller
{   
    public function getAnotherDispatcher($orderId, $dispatcherId, $userId)
    {
    OrderDispatcher::where([
    'order_id' => $orderId,
    'dispatcher_id' => $dispatcherId,
    ])->update(['status' => 'Declined']);

    $dispatcherDeclineIds = OrderDispatcher::where([
        'order_id' => $orderId,
        'status' => 'Declined'
        ])->pluck('dispatcher_id');

    $user = User::find($userId);
    $dispatcher = Dispatcher::whereNotIn('id', $dispatcherDeclineIds)
            ->where([
                'is_available' => true,
                'location' => $user->location,
                'lga' => $user->lga,
                ]) ->first();
                
    OrderDispatcher::create([
        'user_id' => $userId,
        'order_id' => $orderId,
        'dispatcher_id' => $dispatcher ? $dispatcher->id : 0,
        'status' => $dispatcher ? 'Pending' : 'Declined',
    ]);
        
    Dispatcher::where('id', $dispatcherId)->update(['is_available' => true,]);

    return redirect()->route('dispatcher.home');
    }

    public function dispatcherAccepted($orderId)
    {
        OrderDispatcher::where('order_id', $orderId)->update([
            'status' => 'Accepted',
        ]);

        return redirect()->route('dispatcher.home');
    }
    
    public function goodsDelivered($orderId, $dispatcherId)
    {
        OrderDispatcher::where('order_id', $orderId)->update([
            'status' => 'Delivered',
        ]);
        
        Dispatcher::where('id', $dispatcherId)->update([
            'is_available' => true,
        ]);

        return redirect()->route('dispatcher.home');
    }
  }
