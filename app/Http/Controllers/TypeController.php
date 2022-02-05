<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        $type = Type::latest()->get();

        return view('type.index', [
            'type' => $type
        ]);
    }

    public function store(Request $request, Type $type)
    {
        $request->validate([
            'type' => 'required'
        ]);

        $type = Type::create([
            'type'  => $request->type,
        ]);

        return back();
    }

    public function destroy(Request $request ,Type $type)
    {
        $type->delete($request->all);

        return back();
    }
}
