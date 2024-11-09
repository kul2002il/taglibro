<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string content
 * @property string type
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Node extends Model
{
    public const TYPE_TEXT = 'test';

    protected $fillable = [
        'name',
        'content',
        'type,'
    ];
}
