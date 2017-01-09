<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $hidden = ['id', 'pivot'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function tutorial()
    {
        return $this->hasOne(Tutorial::class);
    }
}
