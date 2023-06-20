<?php

namespace App\Http\Controllers;

use App\Models\Dispatcher;
use App\Models\Order;
use App\Models\OrderDispatcher;
use App\Models\User;
use Illuminate\Http\Request;

class OrderDispatcherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orderDispatcher = new OrderDispatcher();
        $dispatcher = Dispatcher::find(1);
        $order = Order::find(1);
        $usering = User::find(1);
        $orderDispatcher->order_id;
        $orderDispatcher->user_id;
        $orderDispatcher->dispatcher_id;

        // dd($orderDispatcher);
        $orderDispatcher->save();
        return redirect('dispatcher.dispatcher_index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
