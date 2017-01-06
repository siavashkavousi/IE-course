<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function record()
    {

    }
}
