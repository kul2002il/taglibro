<?php

namespace Database\Seeders;

use Database\Factories\NodeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        NodeFactory::new()->count('5')->create();
    }
}
