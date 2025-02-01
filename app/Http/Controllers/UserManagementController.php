<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UsersLogin;
class UserManagementController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return view('admin.user-management.view')->with([
            'users' => $users
        ]);  
    }

    public function filter(Request $request)
{
        $query = Users::query();

        // If there's a search term, filter the relevant fields (name, email, role)
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('fname', 'like', '%' . $request->search . '%')
                ->orWhere('mname', 'like', '%' . $request->search . '%')
                ->orWhere('lname', 'like', '%' . $request->search . '%')
                ->orWhere('lname', 'like', '%' . $request->search . '%')
                ->orWhereHas('login', function ($q) use ($request) {
                    $q->where('email', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('login', function ($q) use ($request) {
                    $q->where('role', 'like', '%' . $request->search . '%');
                });
            });
        }

        // If there's a selected role filter
        if ($request->has('role') && $request->role != '') {
            $query->whereHas('login', function ($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        // Retrieve the filtered users
        $users = $query->get();

        // Return the view with filtered users
        return view('admin.user-management.view', compact('users'));
    }
        
    
}
