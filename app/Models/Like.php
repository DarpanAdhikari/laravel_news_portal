<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'u_id',
        'np_post_id',
        'en_post_id',
        'comment_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'u_id');
    }

    public function nepaliPost(): BelongsTo
    {
        return $this->belongsTo(NepaliPost::class, 'np_post_id');
    }

    public function englishPost(): BelongsTo
    {
        return $this->belongsTo(EnglishPost::class, 'en_post_id');
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
