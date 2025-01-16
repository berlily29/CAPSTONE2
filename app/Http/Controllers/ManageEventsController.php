<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageEventsController extends Controller
{
    public function index() {
        return view('admin.manage-events.view');
    } 
}
