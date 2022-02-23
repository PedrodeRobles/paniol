<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Person;
use App\Models\Thing;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        $things = Thing::all();
        $people = Person::all();

        return view('order.index', [
            'orders' => $orders,
            'things' => $things,
            'people' => $people,
        ]);
    }

    // public function create()
    // {
    //     return view('order.create');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'person_id' => 'required',
        ]);

        Order::create([
            'user_id' => auth()->user()->id,
            'identifier' => $request->identifier,
            'person_id' => $request->person_id,
            'return' => 0,
        ]);

        // Cambiar el state_id del 'Thing' que seleccione
        // $thing = Thing::find($request->thing_id);
        // $thing->state_id = 2;
        // $thing->save();


        return redirect()->route('order.index');
    }

    public function show(Order $order)
    {
        $things = Thing::all();

        return view('order.show', compact('order', 'things'));
    }

    public function edit(Order $order, Request $request)
    {
        $things = Thing::all();

        return view('order.edit', compact('order', 'things'));
    }

    public function update(Request $request, Order $order, Thing $thing)
    {
        // $request->validate([
        //     'identifier' => 'required',
        //     'thing_id' => 'required',
        // ]);

        $things = Thing::where('order_id', $order->id)->get();
        $things->toQuery()->update([
            'order_id' => 1,
            'state_id' => 1,
        ]);

        $order->return = 1;

        $order->update();

        return back();
    }

    public function destroy(Order $order)
    {
        // $thing = Thing::find($order->thing_id);
        // $thing->state_id = 1;
        // $thing->save();

        $order->delete();

        return redirect()->route('order.index');
    }
}
