<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    public function index()
    {
        $galleries = auth()->user()->galleries;
        return view('galleries.index', compact('galleries'));
    }


    public function create()
    {
        return view('galleries.create');
    }

    public function store(CreateGalleryRequest $request)
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


    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }


    public function update(UpdateGalleryRequest $request, Gallery $gallery)
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

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);

        $gallery->delete();

       return to_route('galleries.index')->with('message', __('Gallery deleted successfully'));
    }
}
