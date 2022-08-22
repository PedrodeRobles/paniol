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
        $this->authorize('adminOrWorker', Order::class);
        
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
    }

    public function store(Request $request)
    {
        $this->authorize('adminOrWorker', Order::class);

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
        
    }

    public function show(Order $order)
    {
        $this->authorize('adminOrWorker', Order::class);
        
        $things = Thing::where('order_id', $order->id)->get();
        
        return view('order.show', compact('order', 'things'));
    }

    public function edit(Order $order, Request $request)
    {
        $this->authorize('adminOrWorker', Order::class);

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
    }

    //Boton Devolver de cada orden
    public function update(Request $request, Order $order)
    {
        $this->authorize('adminOrWorker', Order::class);

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
            'other_things' => $order->other_things,
        ]);
        
        return redirect()->route('order.index');
    }

    public function destroy(Order $order)
    {
        $this->authorize('adminOrWorker', Order::class);
        
        $order->delete();
        
        return redirect()->route('order.index');
    }

    public function thingOrder(Request $request, Thing $thing)
    {        
        $this->authorize('adminOrWorker', Order::class);

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
    }

    public function exportPdf(Order $order)
    {
        $this->authorize('adminOrWorker', Order::class);

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
        $this->authorize('adminOrWorker', Order::class);

        return Excel::download(new OrdersExport, 'orders-list.xlsx');
    }

    public function importExcel(Request $request)
    {
        $this->authorize('adminOrWorker', Order::class);

        $file = $request->file('file');
        Excel::import(new OrdersImport, $file);

        return back()->with('message', 'Importación de ordenes completado');
    }

    //Add some things that aren´t registered
    public function otherThings(Request $request, Order $order)
    {
        $this->authorize('adminOrWorker', Order::class);

        $request->validate([
            'other_things' => 'required'
        ]);

        $order->update([
            'other_things' => $request->other_things
        ] + $request->all());

        return back();
    }

    /*Internal orders */ 

    public function intern() 
    {
        $this->authorize('adminOrWorker', Order::class);

        $orders = Order::latest()
            ->where('type', 2)
            ->get();

        return view('order.intern', compact('orders'));
    }

    public function addIntern()
    {
        $this->authorize('adminOrWorker', Order::class);

        $order = Order::create([
            'user_id'    => auth()->user()->id,
            'person_id'  => 1,
            'identifier' => 'INTERN',
            'type'       => 2
        ]);

        History::create([
            'user'             => $order->user->name,
            'identifier'       => $order->identifier,
            'person_name'      => $order->person->name,
            'person_last_name' => $order->person->last_name,
            'type'             => 2
        ]);

        return redirect()->route('order.addThingsToIntern', ['order' => $order->id]);
    }

    public function addThingsToIntern(Order $order, Request $request)
    {
        $this->authorize('adminOrWorker', Order::class);

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
