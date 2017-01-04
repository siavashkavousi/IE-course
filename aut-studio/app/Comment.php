<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function game()
    {
        return $this->hasOne(Game::class);
    }
}
