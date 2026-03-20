<?php

namespace App\Http\Controllers;

use App\bases\ApiResponse;
use App\Http\Requests\SongRequest;
use App\Http\Requests\SongUpdateOrderRequest;
use App\Http\Requests\SongUpdateRequest;
use App\Http\Resources\AlbumResource;
use App\Http\Resources\LabelResource;
use App\Http\Resources\SongAlgumStatisticResource;
use App\Http\Resources\SongResource;
use App\Http\Resources\SongSearchResource;
use App\Http\Resources\SongStatisticResource;
use App\Models\Album;
use App\Models\Label;
use App\Models\Song;
use App\Models\SongLabel;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\File;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::query()->with('album');
        $songs->when(request()->query('keyword'), function (Builder $query, $value) {
            $query->whereLike('title', "%$value%");
        });
        $pager = $songs->paginate(request()->query('limit', 10), page: request()->query('cursor', 1));
        return ApiResponse::responseDefault(200, SongSearchResource::collection($pager->all()));
    }

    public function cover(Song $song)
    {
        $file = \Illuminate\Support\Facades\File::get($song->cover_image_path);
        return response()->file($file);
    }

    public function store(SongRequest $request, Album $album)
    {
        $file = $request->file('cover_image');
        $url = $file->move('songs');
        $created = Song::create([
            ...$request->validated(),
            'album_id' => $album->getKey(),
            'is_cover' => (integer)(bool)$request->validated('is_cover'),
            'track_order' => 1,
            'cover_image_path' => $url
        ]);

        $labels = explode(',', $request->validated('label'));
        $labelModels = Label::whereIn('name', $labels)->get();
        foreach ($labels as $id => $label) {
            SongLabel::create([
                'song_id' => $created->getKey(),
                'label_id' => $labelModels[$id]->getKey()
            ]);
        }
        return ApiResponse::responseDefault(201, new SongResource($created));
    }

    public function show(Song $song)
    {
        return ApiResponse::responseDefault(200, new SongResource($song));
    }

    public function update(SongUpdateRequest $request, Album $album, Song $song)
    {
        $file = $request->file('cover_image');
        $url = $file->move('songs');
        $song->load(['album', 'songLabels.label']);
        if ($album->isNot($song->album)) {
            ApiResponse::errorResponse(404, 'Validation failed');
        }
        $song->update([
            ...$request->validated(),
            'is_cover' => (integer)(bool)$request->is_cover,
            'cover_image_path' => $url
        ]);
        return ApiResponse::responseDefault(200, new SongResource($song));
    }

    public function updateOrder(SongUpdateOrderRequest $request, Album $album)
    {
        $songs = Song::whereIn('song_id', $request->validated('song_ids', []))->get();
        foreach ($songs as $id => $song) {
            $song->update([
                'track_order' => ($id + 1)
            ]);
        }
        return ApiResponse::response(200, [
            'success' => true,
        ]);
    }

    public function destroy(Album $album, Song $song)
    {
        $song->load('album');
        if ($album->isNot($song->album)) {
            ApiResponse::errorResponse(404, 'Validation failed');
        }
        $song->delete();

        return ApiResponse::response(201, [
            'success' => true
        ]);
    }

    public function statistics()
    {
        $metrics = request()->query('metrics', 'label');
        $labels = request()->query('labels', 'Pop');
        if (!in_array($metrics, ['label', 'album', 'song'])) {
            ApiResponse::errorResponse(400, 'Invalid parameter');
        }
        if (!Label::where('name', $labels)->exists()) {
            ApiResponse::errorResponse(400, 'Invalid parameter');
        }

        $query = null;
        if ($metrics === 'song') {
            $query = Song::with(['songLabels.label', 'userViewLogs', 'album.publisher'])
                ->withCount('userViewLogs');
            $query->orderBy('user_view_logs_count', 'desc');
            return ApiResponse::responseDefault(200, SongStatisticResource::collection($query->get()));
        } elseif ($metrics === 'album') {
            $query = Album::query()->with(['publisher']);
            $query->with(['songs']);
            $query->withCount('songs');
            $query->orderBy('songs_count', 'desc');
            return ApiResponse::responseDefault(200, SongAlgumStatisticResource::collection($query->get()));
        } elseif ($metrics === 'label') {
            $query = Label::query()->with(['songs' => function ($query) {
                $query->withCount('userViewLogs');
            }]);
            $query->withCount('songs');
            return ApiResponse::responseDefault(200, LabelResource::collection($query->get()));
        }
        $query = Song::with(['songLabels.label', 'userViewLogs', 'album.publisher'])
            ->withCount('userViewLogs');
        $query->orderBy('user_view_logs_count', 'desc');
        return ApiResponse::responseDefault(200, SongStatisticResource::collection($query->get()));
    }
}
