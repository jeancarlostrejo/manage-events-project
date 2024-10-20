<?php

namespace App\Http\Controllers;

use App\Models\Event;

class AttendingSystemController extends Controller
{
    public function __invoke(Event $event)
    {
        $attending = $event->attendings()->where('user_id', auth()->user()->id)->first();

        if ($attending) {
            $attending->delete();
            return null;
        }

        $attending = $event->attendings()->create([
            'user_id' => auth()->user()->id,
            'num_tickets' => 1,
        ]);

        return true;
    }
}
