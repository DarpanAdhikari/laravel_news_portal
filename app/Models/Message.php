<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'read_at',
        'receiver_deleted_at',
        'sender_deleted_at'
    ];

    protected $casts = [
        'body' => 'array',
    ];

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }
}
