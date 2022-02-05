<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function index()
    {
        $state = State::latest()->get();

        return view('state.index', [
            'state' => $state
        ]);
    }

    public function store(Request $request, State $state)
    {
        $request->validate([
            'state' => 'required'
        ]);

        $state = State::create([
            'state'  => $request->state,
        ]);

        return back();
    }

    public function destroy(Request $request ,State $state)
    {
        $state->delete($request->all);

        return back();
    }
}
