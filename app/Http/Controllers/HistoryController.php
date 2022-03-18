<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Order;
use App\Models\Thing;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistoryExport;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::latest()->paginate(10);

        return view('history.index', compact('histories'));
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
        // History::create([
        //     'user' => 1,
        //     'person' => 1,
        //     'identifier' => 'default',
        // ]);

        return back();
    }

    public function show(History $history)
    {
        $thing = Thing::all();

        return view('history.show', compact('history', 'thing'));
    }

    public function exportExcel()
    {
        return Excel::download(new HistoryExport, 'histories-list.xlsx');
    }
}
