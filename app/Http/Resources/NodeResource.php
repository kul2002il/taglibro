<?php

namespace App\Http\Resources;

use App\Http\Tasks\GetLinksFromNodeTask;
use Illuminate\Http\Request;

class NodeResource extends NodeShortResource
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request) + [
            'content'   => $this->resource->content,
            'meta'      => [
                'links' => LinkResource::collection(
                    (new GetLinksFromNodeTask($this->resource))->run()
                ),
            ],
        ];
    }
}
