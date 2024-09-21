<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class LikeSystemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Event $event)
    {
        $like = $event->likes()->where('user_id', auth()->user()->id)->first();

        if ($like) {
            $like->delete();
            return null;
        }

        $like = $event->likes()->create([
            'user_id' => auth()->user()->id,
        ]);

        return true;
    }
}
