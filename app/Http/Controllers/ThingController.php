<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use App\Models\Type;
use App\Models\State;
use Illuminate\Http\Request;

class ThingController extends Controller
{
    public function index()
    {
        $thing = Thing::latest()->get();

        return view('thing.index', [
            'thing' => $thing
        ]);
    }

    public function create()
    {
        $types = Type::all(); 
        $states = State::all(); 

        return view('thing.create', [
            'types' => $types,
            'states' => $states
        ]);
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
        return view('thing.show');
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
            'type_id' => 'required',
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
