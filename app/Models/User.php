<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Notification;

// class User extends Authenticatable implements MustVerifyEmail //use this if you need verification during login
class User extends Authenticatable
{
    use HasApiTokens, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasRoles;

    public $timestamps = false;

    protected $fillable = [
        'u_id',
        'name',
        'email',
        'password',
        'social',
        'location',
        'role',
        'status',
        'profile_photo_path',
        'facebook',
        'twitter',
        'linkedin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'profile_photo_url',
    ];

    // check user online offline remember we have middleware to handle cache
    public function isUserOnline()
    {
        return Cache::has('User-is-Online' . $this->id);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeBlocked($query)
    {
        return $query->where('status', 0);
    }

    // relations of databases
    public function views(): HasMany
    {
        return $this->hasMany(views::class, 'u_id');
    }
    public function subscribed(): HasOne
    {
        return $this->hasOne(Subscriber::class, 'u_id');
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'u_id');
    }
    public function nepaliPosts(): HasMany
    {
        return $this->hasMany(NepaliPost::class, 'author');
    }

    public function englishPosts(): HasMany
    {
        return $this->hasMany(EnglishPost::class, 'author');
    }

    public function sentMessage(): HasMany
    {
        return $this->hasMany(message::class, 'receiver_id');
    }
    public function receiveMessage(): HasMany
    {
        return $this->hasMany(message::class, 'sender_id');
    }
}
