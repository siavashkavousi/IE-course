<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamesList extends Model
{
    protected $table = 'games_list';

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
