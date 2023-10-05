<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];
    protected $guarded = [
        'user_id',
        'created',
        'is_verified',
        'verified',
        'email_verified_at',
        'verify_token',
        'remember_token'
    ];
    protected $hidden = [
        'password',
        'verify_token',
        'remember_token'
    ];
    protected $casts = [
        'name' => 'string',
        'username' => 'string',
        'password' => 'hashed',
        'role' => 'string',
        'created' => 'string',
        'is_verified' => 'boolean',
        'verified' => 'string',
        'email_verified_at' => 'datetime',
        'verify_token' => 'string',
        'remember_token' => 'string'
    ];
    protected $appends = [
        'profile_photo_url'
    ];
    public $timestamps = false;
}