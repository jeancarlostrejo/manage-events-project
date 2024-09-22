<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $events = Event::with(['country:id,name', 'tags:id,name'])->where('start_date', '>=', today())->orderBy('created_at', 'asc')->get();

        return view('welcome', compact('events'));
    }
}
