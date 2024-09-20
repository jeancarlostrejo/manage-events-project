<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Event $event)
    {
        $event->load(['country:id,name', 'city:id,name', 'user:id,name,email']);

        return view('eventsShow', compact('event'));
    }
}
