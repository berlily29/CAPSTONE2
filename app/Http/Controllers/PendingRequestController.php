<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendingRequestController extends Controller
{
    public function index()
    {
        return view('admin.pending-request.view');
    }
}
