<?php


namespace App\Http\Resources;

class GetPostListCollection extends BaseResourceCollection
{
    public function toArray($request)
    {
        return GetPostResource::collection($this->collection);
    }
}
