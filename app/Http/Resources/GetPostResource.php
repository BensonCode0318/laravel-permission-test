<?php


namespace App\Http\Resources;

class GetPostResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this['id'],
            'title'   => $this['title'],
            'content' => $this['content'],
        ];
    }
}
