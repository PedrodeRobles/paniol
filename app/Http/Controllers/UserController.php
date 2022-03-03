<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use App\Imports\UserImport;

class UserController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new UserExport, 'users-list.xlsx');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new UserImport, $file);

        return back();
    }
}
