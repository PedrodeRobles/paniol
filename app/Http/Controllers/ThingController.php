<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use App\Models\Type;
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

        return view('thing.create', ['types' => $types]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'name' => 'required',
        ]);

        // $request->type()->things()->create($request->all());

        $thing = Thing::create([
            'name'  => $request->name,
            'type_id' => $request->type_id,
        ]);

        return redirect()->route('thing.index');
    }

    public function show(Thing $thing)
    {
        return view('thing.show');
    }

    public function edit(Thing $thing)
    {
        return view('thing.edit');
    }

    public function update(Request $request, Thing $thing)
    {
        $request->validate([
            'type_id' => 'required',
            'name' => 'required',
        ]);

        $thing->update();

        return redirect()->route('thing.index');
    }

    public function destroy(Thing $thing)
    {
        $thing->delete();

        return back();
    }
}
