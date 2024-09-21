<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Event $event): RedirectResponse
    {
        $event->comments()->create([
            'user_id' => auth()->user()->id,
            "content" => $request->content
        ]);

        return to_route('eventShow', $event);
    }

    public function destroy(Event $event, Comment $comment): RedirectResponse
    {

        $this->authorize('delete', $comment);

        $comment->delete();

        return to_route('eventShow', $event);
    }
}
