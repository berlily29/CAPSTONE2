<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FindEventsController extends Controller
{
    public function index()
    {
        return view('user.find-events.view');  
    }
}
