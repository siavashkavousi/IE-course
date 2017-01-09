<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $hidden = ['id'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
