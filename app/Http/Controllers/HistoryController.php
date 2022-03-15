<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('history.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'user' => 'required',
        //     'person' => 'required',
        //     'identifier' => 'required',
        // ]);

        // History::create($request->all());
        History::create([
            'user' => 1,
            'person' => 1,
            'identifier' => 'default',
        ]);

        return back();
    }

    public function show(History $history)
    {
        //
    }

    public function edit(History $history)
    {
        //
    }

    public function update(Request $request, History $history)
    {
        //
    }

    public function destroy(History $history)
    {
        //
    }
}
