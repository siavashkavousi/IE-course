<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'email', 'password', 'remember_token', 'is_admin',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
