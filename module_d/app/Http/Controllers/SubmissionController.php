<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Http\Resources\SubmissionResource;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function index()
    {
        return SubmissionResource::collection(Submission::all());
    }

    public function store(SubmissionRequest $request)
    {
        return new SubmissionResource(Submission::create($request->validated()));
    }

    public function show(Submission $submission)
    {
        return new SubmissionResource($submission);
    }

    public function update(SubmissionRequest $request, Submission $submission)
    {
        $submission->update($request->validated());

        return new SubmissionResource($submission);
    }

    public function destroy(Submission $submission)
    {
        $submission->delete();

        return response()->json();
    }
}
