<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'line' => $this->resource->line,
            'node' => new NodeShortResource($this->resource->node)
        ];
    }
}
