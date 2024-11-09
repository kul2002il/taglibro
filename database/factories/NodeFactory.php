<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Node>
 */
class NodeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'    => $this->faker->sentence(3),
            'type'    => 'text',
            'content' => $this->faker->text(),
        ];
    }
}
