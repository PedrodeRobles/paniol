<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Order;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PersonExport;
use App\Imports\PersonImport;

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

    public function show(Person $person)
    {
        $orders = Order::where('person_id', $person->id)
            ->latest()->get();

        return view('people.show', compact('person', 'orders'));
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

    public function exportExcel()
    {
        return Excel::download(new PersonExport, 'people-list.xlsx');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new PersonImport, $file);

        return back();
    }
}
