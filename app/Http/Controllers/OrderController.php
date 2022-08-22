<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Person;
use App\Models\Thing;
use App\Models\History;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use App\Imports\OrdersImport;

class OrderController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 2 ||  auth()->user()->role_id == 3) {
            $orders = Order::latest()
                ->where('type', 1)
                ->get();
            $things = Thing::all();
            $people = Person::latest()->get();
            
            return view('order.index', [
                'orders' => $orders,
                'things' => $things,
                'people' => $people,
            ]);
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
            
            $request->validate([
                'identifier' => 'required',
                'person_id' => 'required',
            ]);
            
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'identifier' => $request->identifier,
                'person_id' => $request->person_id,
            ]);
            
            History::create([
                'user' => $order->user->name,
                'identifier' => $order->identifier,
                'person_name' => $order->person->name,
                'person_last_name' => $order->person->last_name,
            ]);
            
            return redirect()->route('order.index');
        } else {
            abort(403);
        }
    }

    public function show(Order $order)
    {
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
            
            $things = Thing::where('order_id', $order->id)->get();
            
            return view('order.show', compact('order', 'things'));
        } else {
            abort(403);
        }
    }

    public function edit(Order $order, Request $request)
    {
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
            if ($order->type == 1) {
                $query = trim($request->get('search'));
                
                $things =Thing::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('identifier', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->get();
                
                return view('order.edit', [
                    'things' => $things,
                    'search' => $query,
                    'order'  => $order,
                ]);
            } else {
                abort(404);
            }
        } else {
            abort(403);
        }
    }

    //Boton Devolver de cada orden
    public function update(Request $request, Order $order)
    {
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
            
            $things = Thing::where('order_id', $order->id)->get();
            $things->toQuery()->update([
                'order_id' => 1,
                'state' => 1,
            ]);

            $order->return = 2;
            $order->update();
            
            foreach ($things as $thing) {
                if ($request->order_id != 1) {
                    $thing->histories()->attach($order->id); //history_id
                } else {
                    $thing->histories()->detach($order->id); //history_id
                }
            }

            $histories = History::where('id', $order->id)->get();
            $histories->toQuery()->update([
                'updated_at' => $order->updated_at,
            ]);
            
            return redirect()->route('order.index');
        } else {
            abort(403);
        }
    }

    public function destroy(Order $order)
    {
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
            
            $order->delete();
            
            return redirect()->route('order.index');
        } else {
            abort(403);
        }
    }

    public function thingOrder(Request $request, Thing $thing)
    {
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
            
            $request->validate([
                'order_id' => 'required',
            ]);
            
            if ($request->order_id != 1) {
                $thing->state = 2;
            } else {
                $thing->state = 1;
            }
            
            $thing->update($request->all());
            
            return back();
        } else {
            abort(403);
        }
    }

    public function exportPdf(Order $order)
    {
        $things = Thing::where('order_id', $order->id)->get();
        // $things = Thing::all();

        $pdf = Pdf::loadView('order.pdf', ['order' => $order, 'things' => $things]);
        return $pdf->stream();
    }

    // USELESS
    // public function orderHistory()
    // {
    //     $orders = Order::latest()->get();

    //     return view('order.history', compact('orders'));
    // }

    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'orders-list.xlsx');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new OrdersImport, $file);

        return back()->with('message', 'Importación de ordenes completado');
    }

    //Add some things that aren´t registered
    public function otherThings(Request $request, Order $order)
    {
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {

            $request->validate([
                'other_things' => 'required'
            ]);

            $order->update([
                'other_things' => $request->other_things
            ] + $request->all());

            return "HI";

        } else {
            abort(403);
        }
    }

    /*Internal orders */ 

    public function intern() 
    {
        $things = Thing::where('name', 'Netbook')
            ->orWhere('name', 'Netbook 2020')
            ->get();

        $orders = Order::latest()
            ->where('type', 2)
            ->get();

        return view('order.intern', compact('things', 'orders'));
    }

    public function addIntern()
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'person_id' => 1,
            'identifier' => 'INTERN',
        ]);

        History::create([
            'user' => $order->user->name,
            'identifier' => $order->identifier,
            'person_name' => $order->person->name,
            'person_last_name' => $order->person->last_name,
        ]);
    }

    public function addThingsToIntern(Order $order, Request $request)
    {
        if($order->type == 2) {

            $query = trim($request->get('search'));
            
            $things =Thing::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('identifier', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->get();
            
            return view('order.editIntern', [
                'things' => $things,
                'search' => $query,
                'order'  => $order,
            ]);
        } else {
            abort(404);
        }
    }

}
