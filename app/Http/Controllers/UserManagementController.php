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

        // If there's a search term, filter relevant fields
        if ($request->filled('search')) {
            $searchTerms = explode(' ', $request->search);
            $query->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->where('fname', 'like', '%' . $term . '%')
                    ->orWhere('mname', 'like', '%' . $term . '%')
                    ->orWhere('lname', 'like', '%' . $term . '%')
                    ->orWhereHas('login', function ($q) use ($term) {
                        $q->where('email', 'like', '%' . $term . '%')
                            ->orWhere('role', 'like', '%' . $term . '%');
                    });
                }
            });
        }
        
        // Role filter
        if ($request->filled('role')) {
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
