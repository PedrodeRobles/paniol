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
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
            
            $histories = History::latest()->paginate(10);
            
            return view('history.index', compact('histories'));
        } else {
            abort(403);
        }
    }

    public function show(History $history)
    {
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {

            $thing = Thing::all();

            return view('history.show', compact('history', 'thing'));
        } else {
            abort(403);
        }
    }

    public function exportExcel()
    {
        return Excel::download(new HistoryExport, 'histories-list.xlsx');
    }

    public function intern()
    {
        $histories = History::where('type', 2)->get();
        dd($histories);
        return view('history.intern', compact('histories'));
    }

    public function extern()
    {
        $histories = History::where('type', 1)->get();
        
        return view('history.extern', compact('histories'));
    }
}
