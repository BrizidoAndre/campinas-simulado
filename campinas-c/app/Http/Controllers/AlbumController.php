<?php

namespace App\Http\Controllers;

use App\bases\ApiResponse;
use App\Http\Requests\AlbumRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Http\Resources\AlbumIndexResource;
use App\Http\Resources\AlbumResource;
use App\Http\Resources\AlgumSingleResource;
use App\Http\Resources\SongAlbumSearchResource;
use App\Models\Album;
use Illuminate\Database\Eloquent\Builder;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('publisher');
        $albums->when(request()->query('capital'), function (Builder $query, $value) {
            $query->whereLike('title', "%$value%");
        });
        $albums->when(request()->query('year'), function (Builder $query, $value) {
            [$start, $end] = explode('-', $value);
            $query->where('release_year', '>=', $start);
            $query->where('release_year', '<', $end);
        });

        $pager = $albums->paginate(request()->query('limit', 10), page: request()->query('cursor', 1));
        return ApiResponse::response(200, [
            'success' => true,
            'data' => AlbumIndexResource::collection($pager->all()),
            'meta' => [
                'prev_cursor' => $pager->previousPageUrl(),
                'next_cursor' => $pager->nextPageUrl(),
            ],
        ]);
    }

    public function store(AlbumRequest $request)
    {
        $album = Album::create([
            ...$request->validated(),
            'publisher_id' => auth()->id(),
        ]);
        $album->load('publisher');
        return ApiResponse::responseDefault(201, new AlbumResource($album));
    }

    public function show(Album $album)
    {
        return ApiResponse::responseDefault(200, new AlgumSingleResource($album));
    }

    public function update(AlbumUpdateRequest $request, Album $album)
    {
        $album->update($request->validated());
        return ApiResponse::responseDefault(200, new AlbumResource($album));
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return ApiResponse::response(200, [
            'success' => true,
        ]);
    }

    public function cover(Album $album)
    {

    }

    public function songs(Album $album)
    {
        return ApiResponse::responseDefault(200, SongAlbumSearchResource::collection($album->songs));
    }
}
