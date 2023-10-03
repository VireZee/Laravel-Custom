<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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
        'verify_token' => 'string',
        'remember_token' => 'string'
    ];
    protected $appends = [
        'profile_photo_url'
    ];
    public $timestamps = false;
}