<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserViewLogRequest;
use App\Http\Resources\UserViewLogResource;
use App\Models\UserViewLog;

class UserViewLogController extends Controller
{
    public function index()
    {
        return UserViewLogResource::collection(UserViewLog::all());
    }

    public function store(UserViewLogRequest $request)
    {
        return new UserViewLogResource(UserViewLog::create($request->validated()));
    }

    public function show(UserViewLog $userViewLog)
    {
        return new UserViewLogResource($userViewLog);
    }

    public function update(UserViewLogRequest $request, UserViewLog $userViewLog)
    {
        $userViewLog->update($request->validated());

        return new UserViewLogResource($userViewLog);
    }

    public function destroy(UserViewLog $userViewLog)
    {
        $userViewLog->delete();

        return response()->json();
    }
}
