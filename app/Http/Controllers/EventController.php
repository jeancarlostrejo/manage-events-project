<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Country;
use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{

    public function index(): View
    {
        $events = Event::with('country')->get();

        return view('events.index', compact('events'));
    }

    public function create(): View
    {
        $countries = Country::get(['id', 'name']);
        $tags = Tag::get(['id', 'name']);

        return view('events.create', compact('countries', 'tags'));
    }

    public function store(CreateEventRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $data['image'] = Storage::disk('public')->put('images', $request->image);

            $event = auth()->user()->events()->create($data);
            $event->tags()->attach($request->tags);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('events.create')->with('error', $th->getMessage());
        }

        return to_route('events.index')->with('message', __('Event created successfully'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Event $event): View
    {
        $event->load('tags');
        $countries = Country::get(['id', 'name']);
        $tags = Tag::get(['id', 'name']);
        
        return view('events.edit', compact('countries', 'tags', 'event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($event->image);
                $data['image'] = Storage::disk('public')->put('images', $request->image);
            } else {
                $data['image'] = $event->image;
            }

            $event->update($data);
            $event->tags()->sync($request->tags);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return to_route('events.index')->with('error', $th->getMessage());
        }

        return to_route('events.index')->with('message', 'Event update successfully');
    }

    public function destroy(Event $event)
    {

        Storage::disk('public')->delete($event->image);
        
        DB::beginTransaction();
        
        try {
            $event->tags()->detach($event->tags);
            $event->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return to_route('events.index')->with('error', $th->getMessage());
        }

        return to_route('events.index')->with('message', __('Event deleted successfully'));


    }
}
