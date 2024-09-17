<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Models\Country;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{

    public function index(): View
    {
        return view('events.index');
    }

    public function create(): View
    {
        $countries = Country::get(['id', 'name']);
        $tags = Tag::get(['id', 'name']);
        return view('events.create', compact('countries', 'tags'));
    }

    public function store(CreateEventRequest $request)
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

        return to_route('events.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
