<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{

    public function index(): View
    {
        $galleries = auth()->user()->galleries;
        return view('galleries.index', compact('galleries'));
    }


    public function create(): View
    {
        return view('galleries.create');
    }

    public function store(CreateGalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        $data['image'] = Storage::disk('public')->put('galleries', $request->image);

        auth()->user()->galleries()->create($data);

        return to_route('galleries.index')->with('message', __('Gallery created successfully'));
        
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Gallery $gallery): View
    {
        return view('galleries.edit', compact('gallery'));
    }


    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();

        if($request->hasFile('image')){
            Storage::disk('public')->delete($gallery->image);
            $data['image'] = Storage::disk('public')->put('galleries', $request->image);
        } else {
            $data['image'] = $gallery->image;
        }

        $gallery->update($data);

        return to_route('galleries.index')->with('message', __('Gallery updated successfully'));
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        Storage::disk('public')->delete($gallery->image);

        $gallery->delete();

       return to_route('galleries.index')->with('message', __('Gallery deleted successfully'));
    }
}
