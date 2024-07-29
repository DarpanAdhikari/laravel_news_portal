<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbuseReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'u_id',
        'en_post_id',
        'np_post_id',
        'comment_id',
        'complaints'
    ];
}
