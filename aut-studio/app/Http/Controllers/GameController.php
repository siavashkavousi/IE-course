<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Game;
use Illuminate\Http\Request;

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

    public function leaderboard($title)
    {

    }

    public function comments(Request $request, $title)
    {
        $game = Game::where('title', $title)->first();
        $comments = Comment::where('game_id', $game->id)->get();

        $offset = $request->query('offset');
        $comments = filterComments($comments);
        $comments = array_slice($comments, $offset, 2);

        return makeSuccessResponse(['comments' => $comments]);
    }
}
