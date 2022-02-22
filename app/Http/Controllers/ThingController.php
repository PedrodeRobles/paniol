<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Thing;
use App\Models\Type;
use App\Models\State;
use Illuminate\Http\Request;

class ThingController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::latest()->get();

        if ($request) {
            $query = trim($request->get('search'));
            if($query == 'EN USO') {
                $query = 2;
            } elseif ($query == 'en uso') {
                $query = 2;
            } elseif ($query == 'EN PAÑOL') {
                $query = 1;
            } elseif ($query == 'en pañol') {
                $query = 1;
            }

                $things =Thing::where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('state_id', 'LIKE', '%' . $query . '%')
                    ->orderBy('id', 'asc')
                    ->get();

                    return view('thing.index', [
                        'things' => $things,
                        'search' => $query,
                        'orders' => $orders
                    ]);
        }

        // $things = Thing::latest()->get();

        // return view('thing.index', [
        //     'things' => $things,
        //     'text' => $text
        // ]);
    }

    public function create(Request $request)
    {
        $types = Type::all(); 
        $states = State::all(); 
        $orders = Order::all(); 

        if($request->user()->id == 1 || 2 || 3 || 4 ) {
            return view('thing.create', [
                'types' => $types,
                'states' => $states,
                'orders' => $orders,
            ]);
        } else {
            return abort(403);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'name' => 'required',
            'state_id' => 'required',
        ]);

        $thing = Thing::create([
            'name'  => $request->name,
            'type_id' => $request->type_id,
            'state_id' => $request->state_id,
            'order_id' => 1,
        ]);

        // return redirect()->route('thing.index');
        return back();
    }

    public function show(Thing $thing)
    {
        return view('thing.show', compact('thing'));
    }

    public function edit(Thing $thing)
    {
        $types = Type::all(); 
        $states = State::all();

        return view('thing.edit', [
            'types' => $types,
            'states' => $states,
            'thing' => $thing
        ]);
    }

    public function update(Request $request, Thing $thing)
    {
        $request->validate([
            'order_id' => 'required',
        ]);

        if ($request->order_id != 1) {
            $thing->state_id = 2;
        } else {
            $thing->state_id = 1;
        }

        $thing->update($request->all());

        return back();
        // return redirect()->route('order.index');
    }

    public function destroy(Thing $thing)
    {
        $thing->visibility = 0;
        $thing->save();

        return back();
    }

    // public function return(Request $request ,Thing $thing)
    // {
    //     // $request->validate([
    //     //     'order_id' => 'required',
    //     // ]);

    //     $thing->update([
    //         'order_id' => 1,
    //         'state_id' => 1,
    //     ]);

    //     return back();
    // }
}
