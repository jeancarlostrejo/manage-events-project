<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventShowController extends Controller
{
    public function __invoke(Event $event)
    {
        $event->load(['country:id,name', 'city:id,name', 'user:id,name,email']);

        if (auth()->user()) {
            $like = $event->likes()->where('user_id', auth()->user()->id)->first();
            $eventSaved = $event->savedEvents()->where('user_id', auth()->user()->id)->first();
            $attending = $event->attendings()->where('user_id', auth()->user()->id)->first();
        } else {
            $like = null;
            $eventSaved = null;
            $attending = null;
        }
        return view('eventsShow', compact('event', 'like', 'eventSaved', 'attending'));
    }
}
