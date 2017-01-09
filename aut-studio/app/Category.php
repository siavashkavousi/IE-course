<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = ['id', 'pivot'];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
