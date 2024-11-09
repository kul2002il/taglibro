<?php

namespace App\Http\Resources;

use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Node $resource
 */
class NodeShortResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id'        => $this->resource->id,
            'name'      => $this->resource->name,
            'type'      => $this->resource->type,
            'createdAt' => $this->resource->created_at->getTimestampMs(),
            'updatedAt' => $this->resource->updated_at->getTimestampMs(),
        ];
    }
}