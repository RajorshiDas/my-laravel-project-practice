<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    protected $fillable = [

        'title',
        'body',
        'image',
    ];
    use HasFactory;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
