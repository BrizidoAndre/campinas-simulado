<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttractionRequest;
use App\Http\Resources\AttractionResource;
use App\Models\Attraction;

class AttractionController extends Controller
{
    public function index()
    {
        return AttractionResource::collection(Attraction::all());
    }

    public function store(AttractionRequest $request)
    {
        return new AttractionResource(Attraction::create($request->validated()));
    }

    public function show(Attraction $attraction)
    {
        return new AttractionResource($attraction);
    }

    public function update(AttractionRequest $request, Attraction $attraction)
    {
        $attraction->update($request->validated());

        return new AttractionResource($attraction);
    }

    public function destroy(Attraction $attraction)
    {
        $attraction->delete();

        return response()->json();
    }
}
