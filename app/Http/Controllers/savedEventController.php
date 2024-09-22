<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class savedEventController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $events = Event::with('savedEvents')->whereHas('savedEvents', function ($query){
            $query->where('user_id', auth()->user()->id);
        })->get();

        return view('events.savedEvents', compact('events'));
    }
}
