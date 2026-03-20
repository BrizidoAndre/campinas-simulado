<?php

namespace App\Http\Controllers;

use App\Http\Requests\Info_itemRequest;
use App\Http\Resources\Info_itemResource;
use App\Models\Info_item;

class Info_itemController extends Controller
{
    public function index()
    {
        return Info_itemResource::collection(Info_item::all());
    }

    public function store(Info_itemRequest $request)
    {
        return new Info_itemResource(Info_item::create($request->validated()));
    }

    public function show(Info_item $info_item)
    {
        return new Info_itemResource($info_item);
    }

    public function update(Info_itemRequest $request, Info_item $info_item)
    {
        $info_item->update($request->validated());

        return new Info_itemResource($info_item);
    }

    public function destroy(Info_item $info_item)
    {
        $info_item->delete();

        return response()->json();
    }
}
