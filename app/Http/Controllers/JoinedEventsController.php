<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JoinedEventsController extends Controller
{
    private function getEvents()
    {
        return [
            ['id' => 1, 'name' => 'General Assembly'],
            ['id' => 2, 'name' => 'Youth Dev Training'],
        ];
    }

    public function index()
    {
        $events = $this->getEvents();
        $event_id = $events[0]['id'] ?? null;
        return redirect()->route('user.joinevents.announcement', ['event_id' => $event_id]);
    }

    public function announcement($event_id)
    {
        $events = $this->getEvents();
        $announcements = $this->getAnnouncements($event_id);

        return view('user.joined-events.view', compact('events', 'event_id', 'announcements'));
    }

    public function stories($event_id)
    {
        $events = $this->getEvents();
        $stories = $this->getStories($event_id);

        return view('user.joined-events.view', compact('events', 'event_id', 'stories'));
    }

    public function eventDetails($event_id)
    {
        $events = $this->getEvents();
        $details = $this->getEventDetails($event_id);

        return view('user.joined-events.view', compact('events', 'event_id', 'details'));
    }

    private function getAnnouncements($event_id)
    {
        $data = [
            1 => ["General Assembly Announcement"],
            2 => ["Youth Dev Training Announcement"],
        ];

        return $data[$event_id] ?? [];
    }

    private function getStories($event_id)
    {
        return [];
    }

    private function getEventDetails($event_id)
    {
        return [];
    }
}
