<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class SaveSystemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Event $event)
    {
        $savedEvent = $event->savedEvents()->where('user_id', auth()->user()->id)->first();

        if ($savedEvent) {
            $savedEvent->delete();
            return null;
        }

        $savedEvent = $event->savedEvents()->create([
            'user_id' => auth()->user()->id,
        ]);

        return true;
    }
}
