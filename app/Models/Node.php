<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string content
 * @property string $type
 */
class Node extends Model
{
    public const TYPE_TEXT = 'test';
}
