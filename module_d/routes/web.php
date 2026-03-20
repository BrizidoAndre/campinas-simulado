<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::post('/', function (\App\Http\Requests\SubmissionRequest $request) {
    \App\Models\Submission::create($request->validated());
    session()->flash('info', 'Submission sent!');
    return redirect()->route('home');
});
