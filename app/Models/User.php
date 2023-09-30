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
        'created',
        'verified'
    ];
    protected $guarded = [
        'user_id'
    ];
    protected $hidden = [
        'password'
    ];
    protected $casts = [
        'name' => 'string',
        'username' => 'string',
        'password' => 'hashed',
        'role' => 'string',
        'created' => 'string',
        'verified' => 'string'
    ];
    protected $appends = [
        'profile_photo_url'
    ];
    public $timestamps = false;
}