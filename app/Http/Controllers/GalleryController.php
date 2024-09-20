<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
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
