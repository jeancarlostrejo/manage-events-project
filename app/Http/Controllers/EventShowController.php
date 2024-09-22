<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventShowController extends Controller
{
    public function __invoke(Event $event): View
    {
        $event->load(['country:id,name', 'city:id,name', 'user:id,name,email', 'comments' => function ($query) {
            $query->orderBy('created_at', 'desc')
                ->select('id', 'content', 'user_id', 'event_id', 'created_at')
                ->with(['user' => function ($query) {
                    $query->select('id', 'name');
                }]);
        }]);

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
