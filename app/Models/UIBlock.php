<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UIBlock extends Model
{
    /** @use HasFactory<\Database\Factories\UIBlockFactory> */
    use HasFactory;

    protected $table = 'ui_blocks';

    protected $fillable = [
        'title',
        'type',
        'content',
        'status',
        'display_order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'display_order' => 'integer',
    ];
}
