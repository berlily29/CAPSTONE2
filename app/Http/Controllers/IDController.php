<?php

namespace App\Http\Controllers;

use App\Models\ID;
use App\Models\UsersLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IDController extends Controller
{

    protected function delete_existing($id) {
        ID::where('user_id' ,$id)->delete();
    }

    public function index() {
        return view('register.id')->with([            
            'is_rejected' => session('is_rejected')
    ]);
    }




    public function store(Request $request ) {
        $request->validate([
            'type'=> 'string',
            'file'=> 'required|file'
        ]);

        $email = session('email');


        $path = '/uploads/id/';


        if(!(Storage::exists($path))) {
            Storage::makeDirectory($path);
        }

        $user = UsersLogin::where('email', $email)->first();
        $file_name = $user->user_id . '.' . $request->file('file')->getClientOriginalExtension();


        //store the file in the file tree
        $request->file('file')->storeAs($path, $file_name, 'public');


        //if the file is uploaded, then proceed to save in the database

        $this->delete_existing($user->user_id);
        ID::create([
            'user_id'=> $user->user_id,
            'id_type'=> $request->type,
            'attachment'=> $file_name,
            'status'=> 'Pending'
        ]);

        Auth::login($user);
        


        return redirect()-> route('user.dashboard');


    }

}
