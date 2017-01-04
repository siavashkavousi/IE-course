<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
