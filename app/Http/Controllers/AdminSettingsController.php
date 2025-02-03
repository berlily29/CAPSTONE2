<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AdminSettingsController extends Controller
{
    public function index() {
        return view('admin.settings.view')->with([
            'user'=> FacadesAuth::user()->user
        ]);
    }
}
