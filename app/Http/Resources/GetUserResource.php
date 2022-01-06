<?php


namespace App\Http\Resources;

class GetUserResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this['id'],
            'account' => $this['account'],
        ];
    }
}
