<?php

namespace Tests\Feature\Node\TextNode;

use App\Models\Node;
use Carbon\Carbon;
use Database\Factories\NodeFactory;
use Tests\TestCase;

class TextNodeTest extends TestCase
{
    public function testLinks(): void
    {
        Carbon::setTestNow('2024-08-15 12:00');
        NodeFactory::new()->state([
            'id'   => 1,
            'name' => 'Node1'
        ])->create();
        /** @var Node $node2 */
        $node2 = NodeFactory::new()->state([
            'id'      => 2,
            'name'    => 'Node2',
            'content' => 'This is link to [[Node1]] and [[Non exist node]]. It\'s perfect.'
        ])->create();

        $node2->updateLinks();

        $response = $this->get('api/nodes/2');

        $response->assertStatus(200);
        $response->assertExactJson([
            'data' => [
                'id'        => 2,
                'name'      => 'Node2',
                'type'      => 'text',
                'content'   => 'This is link to [[Node1]]. It\'s perfect.',
                'createdAt' => 1723723200000,
                'updatedAt' => 1723723200000,
            ],
        ]);
    }
}
