<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Http\Resources\LabelResource;
use App\Models\Label;

class LabelController extends Controller
{
    public function index()
    {
        return LabelResource::collection(Label::all());
    }

    public function store(LabelRequest $request)
    {
        return new LabelResource(Label::create($request->validated()));
    }

    public function show(Label $label)
    {
        return new LabelResource($label);
    }

    public function update(LabelRequest $request, Label $label)
    {
        $label->update($request->validated());

        return new LabelResource($label);
    }

    public function destroy(Label $label)
    {
        $label->delete();

        return response()->json();
    }
}
