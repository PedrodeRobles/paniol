<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index()
    {
        $people = People::latest()->get();

        return view('people.index', [
            'people' => $people
        ]);
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'place' => 'required',
        ]);

        $person = People::create([
            'name'  => $request->name,
            'place' => $request->place,
        ]);

        return back();
    }

    public function show(People $people)
    {
        //
    }

    public function edit(People $people)
    {
        return view('people.edit', compact('people'));
    }

    public function update(Request $request, People $people)
    {
        $request->validate([
            'name'  => 'required',
            'place' => 'required',
        ]);

        $people->update($request->all());

        return redirect()->route('people.index');
    }

    public function destroy(People $people)
    {
        $people->delete();

        return redirect()->route('people.index');
    }
}
