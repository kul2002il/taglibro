<?php

namespace App\Http\Tasks;

use App\Models\Node;
use Illuminate\Support\Collection;

class GetLinksFromNodeTask
{
    public function __construct(
        private Node $node
    ) {
    }

    /**
     * @return Node[]|Collection<Node>
     */
    public function run(): array|Collection
    {
        $names = $this->getLinksFromContent();
        $nodes = Node::query()->whereIn('name', $names)->get()->keyBy('name');

        return collect($names)->map(fn (string $name) => (object)[
            'line' => "[[$name]]",
            'node' => $nodes[$name] ?? null,
        ]);
    }

    private function getLinksFromContent(): array
    {
        $matches = [];
        preg_match_all('/\[\[(.+?)]]/', $this->node->content, $matches);

        return $matches[1];
    }
}
