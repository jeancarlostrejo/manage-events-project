<?php

namespace App\Http\Controllers;

use App\Models\Event;

class AttendingEventController extends Controller
{
    public function __invoke()
    {
        $events = Event::with('attendings')->whereHas('attendings', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();

        return view('events.attendingEvent', compact('events'));
    }
}
