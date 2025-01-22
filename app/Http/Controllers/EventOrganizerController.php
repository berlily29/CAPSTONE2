<?php

namespace App\Http\Controllers;

use App\Models\EventCategories;
use Illuminate\Http\Request;

class EventOrganizerController extends Controller
{
    public function request_event_index() {

        $categories = EventCategories::with('subcategories')->whereNull('parent_id')->get();
        return view('organizer.forms.event', compact('categories'));
    }
}
