<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role_id != 3) {
            abort(403);
        }

        $users = User::latest()->get();
        $roles = Role::all();

        if ($request) {
            $query = trim($request->get('search'));

            $users = User::latest()->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('id', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->get();
                
                return view('roles.index', [
                    'users' => $users,
                    'roles' => $roles,
                    'search' => $query
                ]);
        }

    }

    public function updateRole(Request $request, User $user)
    {
        if (auth()->user()->role_id != 3) {
            abort(403);
        }

        $user->update([
            'role_id' => $request->role_id
        ]);

        return redirect()->back();
    }

}
