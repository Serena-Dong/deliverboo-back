<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function receve(Request $request)
    {
        $data = $request->all();

        $order = new Order();
        $order->address = $data['address'];
        $order->total_order = $data['total_order'];
        $order->phone_number = $data['phone_number'];
        $order->guest_name = $data['guest_name'];
        $order->status = $data['status'];
        $order->restaurant_id = $data['restaurantid'];
        $order->save();
        dd($data);
        return response(null, 204);
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
