<?php

namespace App\Http\Controllers;

use App\Http\Requests\{OrderRequest, OrderUpdateRequest};
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $orders = Order::whereHas('person')->with('person')->get();
        return response()->json([
            'success' =>1,
            'orders' => $orders
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->all());
        return response()->json([
            'success' => 1,
            'order' => $order
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json([
            'success' =>1,
            'order' => $order->load('person')
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $order->update($request->all());
        return response()->json([
            'success' => 1,
            'order' => $order
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->is_delete = true;
        $order->save();

        return response()->json([
            'success' => 1
        ]);

    }
}
