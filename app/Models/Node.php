<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $content
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Node extends Model
{
    public const TYPE_TEXT = 'test';

    protected $fillable = [
        'name',
        'content',
        'type,'
    ];

    public function updateLinks(): void
    {
        $names = $this->getLinksFromContent();
        $nodes = self::query()->whereIn('name', $names)->get();
    }

    public function getLinksFromContent(): array
    {
        $matches = [];
        preg_match_all('/\[\[(.+?)\]\]/', $this->content, $matches);

        return $matches[1];
    }
}
