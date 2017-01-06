<?php

namespace App\Http\Controllers;

use App\Game;

class GameController extends Controller
{
    public function game()
    {
        return view('game');
    }

    public function header($title)
    {
        $game = Game::where('title', $title)->first();
        return makeSuccessResponse(['game' => filterGame($game)]);
    }

    public function info($title)
    {
        $game = Game::where('title', $title)->first();
        return makeSuccessResponse(['game' => filterGame($game)]);
    }
}
