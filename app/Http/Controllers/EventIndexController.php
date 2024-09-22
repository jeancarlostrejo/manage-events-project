<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventIndexController extends Controller
{
    public function __invoke(): View
    {
        $events = Event::with(['country:id,name', 'tags:id,name'])->orderBy('created_at', 'asc')->paginate(2);

        return view('eventIndex', compact('events'));
    }
}
