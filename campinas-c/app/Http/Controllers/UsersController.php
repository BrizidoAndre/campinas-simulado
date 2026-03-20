<?php

namespace App\Http\Controllers;

use App\bases\ApiResponse;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersUpdateRequest;
use App\Http\Resources\UsersResource;
use App\Models\Users;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::query();
        $pageLimit = request()->query('limit', 10);
        $page = request()->query('cursor', 1);
        $pager = $users->paginate($pageLimit, page: $page);
        return ApiResponse::response(200, [
            'success' => true,
            'data' => UsersResource::collection($users->get()),
            'meta' => [
                'next_cursor' => $pager->nextPageUrl(),
                'prev_cursor' => $pager->previousPageUrl()
            ],
        ]);
    }

    public function store(UsersRequest $request)
    {
        return new UsersResource(Users::create($request->validated()));
    }

    public function show(Users $users)
    {
        return new UsersResource($users);
    }

    public function update(UsersUpdateRequest $request, Users $users)
    {
        $adminCount = Users::where(['role' => 'admin'])->count();
        if ($adminCount === 1 && $users->is(auth()->user())) {
            ApiResponse::errorResponse(403, 'Last admin demotion forbidden');
        }
        if ($users->is_banned) {
            ApiResponse::errorResponse(409, 'Banned user update failed');
        }
        $users->update($request->validated());
        return ApiResponse::responseDefault(200, new UsersResource($users));
    }

    public function ban(Users $users)
    {
        if ($users->is(auth()->user())) {
            ApiResponse::errorResponse(400, 'Cannot ban self');
        }
        if ($users->role === 'admin') {
            ApiResponse::errorResponse(400, 'Cannot ban another admin');
        }
        $users->update([
            'is_banned' => true,
        ]);
        return ApiResponse::responseDefault(200, new UsersResource($users));
    }

    public function destroy(Users $users)
    {
        $users->delete();

        return response()->json();
    }

    public function unban(Users $users)
    {
        $users->update([
            'is_banned' => false
        ]);
        return ApiResponse::responseDefault(200, new UsersResource($users));
    }
}
