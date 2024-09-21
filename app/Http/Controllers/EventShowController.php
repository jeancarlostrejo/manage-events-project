<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventShowController extends Controller
{
    public function __invoke(Event $event)
    {
        $event->load(['country:id,name', 'city:id,name', 'user:id,name,email']);

        if(auth()->user()) {
            $like = $event->likes()->where('user_id', auth()->user()->id)->first();
        } else {
            $like = null;
        }

        return view('eventsShow', compact('event', 'like'));
    }
}
