<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $person = Person::latest()->get();

        return view('people.index', [
            'person' => $person
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

        $person = Person::create([
            'name'  => $request->name,
            'place' => $request->place,
        ]);

        return back();
    }

    public function show(People $people)
    {
        //
    }

    public function edit(Person $person)
    {
        return view('people.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $request->validate([
            'name'  => 'required',
            'place' => 'required',
        ]);

        $person->update($request->all());

        return redirect()->route('people.index');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return back();
    }
}
