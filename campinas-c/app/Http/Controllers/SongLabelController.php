<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongLabelRequest;
use App\Http\Resources\SongLabelResource;
use App\Models\SongLabel;

class SongLabelController extends Controller
{
    public function index()
    {
        return SongLabelResource::collection(SongLabel::all());
    }

    public function store(SongLabelRequest $request)
    {
        return new SongLabelResource(SongLabel::create($request->validated()));
    }

    public function show(SongLabel $songLabel)
    {
        return new SongLabelResource($songLabel);
    }

    public function update(SongLabelRequest $request, SongLabel $songLabel)
    {
        $songLabel->update($request->validated());

        return new SongLabelResource($songLabel);
    }

    public function destroy(SongLabel $songLabel)
    {
        $songLabel->delete();

        return response()->json();
    }
}
