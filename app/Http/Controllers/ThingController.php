<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use App\Models\Type;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThingController extends Controller
{
    public function index(Request $request)
    {
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
                        'search' => $query
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

        if($request->user()->id == 1 || 2 || 3 || 4 ) {
            return view('thing.create', [
                'types' => $types,
                'states' => $states
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
        ]);

        return redirect()->route('thing.index');
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
            'name' => 'required',
            'state_id' => 'required',
        ]);

        $thing->update($request->all());

        return redirect()->route('thing.index');
    }

    public function destroy(Thing $thing)
    {
        $thing->delete();

        return back();
    }
}
