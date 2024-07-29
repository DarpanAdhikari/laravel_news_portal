<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NepaliPost extends Model
{
    use HasFactory, SoftDeletes, Notifiable;
    protected $fillable = [
        'author',
        'title',
        'en_post_id',
        'slug',
        'feature_img',
        'keywords',
        'tags',
        'meta_description',
        'category',
        'sub_category',
        'content',
        'status',
    ];
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'np_post_id');
    }
    public function views(): HasMany
    {
        return $this->hasMany(views::class, 'np_post_id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'np_post_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author');
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(EnglishPost::class, 'en_post_id')->withTrashed();
    }

    public function scopePosts($query)
    {
        return $query->where('status', 1);
    }
    public function scopeDrafts($query)
    {
        return $query->where('status', 0);
    }
}
