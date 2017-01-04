<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    public function game()
    {
        return $this->hasOne(Game::class);
    }
}
