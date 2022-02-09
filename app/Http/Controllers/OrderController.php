<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Thing;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        $things = Thing::all();

        return view('order.index', [
            'orders' => $orders,
            'things' => $things
        ]);
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'name_of_thing' => 'required',
        ]);

        Order::create($request->all());

        return redirect()->route('order.index');
    }

    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'identifier' => 'required'
        ]);

        $order->update($request->all());

        return redirect()->route('order.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('order.index');
    }
}
