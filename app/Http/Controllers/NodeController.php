<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNodeRequest;
use App\Http\Requests\UpdateNodeRequest;
use App\Http\Resources\NodeResource;
use App\Models\Node;
use Illuminate\Http\Resources\Json\JsonResource;

class NodeController extends Controller
{
    public function index(): JsonResource
    {
        return NodeResource::collection(
            Node::query()
                ->orderBy('updated_at', 'desc')
                ->limit('20')
                ->get()
        );
    }

    public function store(StoreNodeRequest $request): JsonResource
    {
        $node = new Node($request->validated());
        $node->save();

        return new NodeResource($node);
    }

    public function show(Node $node): JsonResource
    {
        return new NodeResource($node);
    }

    public function update(UpdateNodeRequest $request, Node $node): JsonResource
    {
        $node->fill($request->validated());
        $node->save();

        return new NodeResource($node);
    }

    public function destroy(Node $node): JsonResource
    {
        $node->delete();

        return response()->json([
            'success_delete' => $node->delete(),
        ]);
    }
}
