<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Thing;
use App\Models\Type;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ThingExport;
use App\Imports\ThingImport;

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

                $things =Thing::latest()->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('identifier', 'LIKE', '%' . $query . '%')
                    ->orWhere('state', 'LIKE', '%' . $query . '%')
                    ->orderBy('id', 'asc')
                    ->get();

                    return view('thing.index', [
                        'things' => $things,
                        'search' => $query,
                        'orders' => $orders
                    ]);
        }
    }

    public function create(Request $request)
    {
        $types = Type::all(); 
        // $states = State::all(); 
        $orders = Order::all(); 

        if($request->user()->id == 1 || 2 || 3 || 4 ) {
            return view('thing.create', [
                'types' => $types,
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
        ]);

        $things = Thing::all();
        $types = Type::all();

        $type_id =  $request->type_id;
        $subName = strtoupper(substr($request->name, 0, 3));
        $num = 1;

        foreach ($types as $type) {
            if ($type_id == $type->id) {
                $typeName = strtoupper(substr($type->type, 0, 3));
            }
        }

        foreach ($things as $thing) {
            if ($thing->identifier == $typeName . '-' . $subName . '-' . $num) {
                $num = $num + 1;
            }
        }

        Thing::create([
            'name'  => ucfirst($request->name),
            'type_id' => $request->type_id,
            'order_id' => 1,
            'identifier' => $typeName . '-' . $subName . '-' . $num,
            'description' => $request->description
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

        return view('thing.edit', [
            'types' => $types,
            'thing' => $thing
        ]);
    }

    public function update(Request $request, Thing $thing)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $thing->update(
            ['name'  => ucfirst($request->name)],
            $request->all());

        // return back();
        return redirect()->route('thing.index');
    }

    public function destroy(Thing $thing)
    {
        $thing->visibility = 2;
        $thing->save();

        return back();
    }

    public function paperBin(Request $request)
    {
        // $things = Thing::where('visibility', 2)->get();

        if ($request) {
            $query = trim($request->get('search'));
            }

                $things =Thing::where('visibility', 2)
                    ->where('name', 'LIKE', '%' . $query . '%')
                    ->where('identifier', 'LIKE', '%' . $query . '%')
                    ->orderBy('id', 'asc')
                    ->get();

                return view('thing.bin', compact('things'));
    }

    public function restore(Thing $thing)
    {
        $thing->visibility = 1;
        $thing->save();

        return back();
    }

    public function exportExcel()
    {
        return Excel::download(new ThingExport, 'things-list.xlsx');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ThingImport, $file);

        return back();
    }
}
