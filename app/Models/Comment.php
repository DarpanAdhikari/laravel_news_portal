<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'u_id',
        'np_post_id',
        'en_post_id',
        'body',
        'abuse_report',
        'parent_id',
    ];
   
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'comment_id');
    }
    public function nepaliPost(): BelongsTo
    {
        return $this->belongsTo(NepaliPost::class, 'np_post_id');
    }

    public function englishPost(): BelongsTo
    {
        return $this->belongsTo(EnglishPost::class, 'en_post_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'u_id');
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function abuse(): HasMany
    {
        return $this->hasMany(AbuseReport::class, 'comment_id');
    }
}
