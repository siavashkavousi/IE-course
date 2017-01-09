<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $hidden = ['id', 'game_id'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
