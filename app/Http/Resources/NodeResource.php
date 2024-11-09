<?php

namespace App\Http\Resources;

use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Node $resource
 */
class NodeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->resource->type,
            'content' => $this->resource->content,
        ];
    }
}
