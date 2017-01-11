<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Game;
use App\Record;
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
        return make_success_response(['game' => filter_game($game)]);
    }

    public function info($title)
    {
        $game = Game::where('title', $title)->first();
        return make_success_response(['game' => filter_game($game)]);
    }

    public function leaderboard($title)
    {
        $game = Game::where('title', $title)->first();
        $records = Record::where('game_id', $game->id)->get();
        return make_success_response(['leaderboard' => $this->filterRecords($records)]);
    }

    public function comments(Request $request, $title)
    {
        $game = Game::where('title', $title)->first();
        $comments = Comment::where('game_id', $game->id)->get();

        $offset = $request->query('offset');
        $comments = filter_comments($comments);
        $comments = array_slice($comments, $offset, 2);

        return make_success_response(['comments' => $comments]);
    }

    public function relatedGames($title)
    {
        $game = Game::where('title', $title)->first();
        $relatedGames = [];
        foreach ($game->categories as $category) {
            foreach ($category->games as $item) {
                if ($item['title'] == $title)
                    continue;
                $relatedGames = array_add($relatedGames, $item['title'], $item);
            }
        }
        list($keys, $values) = array_divide($relatedGames);
        return make_success_response(['games' => $values]);
    }

    private function filterRecords($records)
    {
        foreach ($records as $index => $record)
            $records[$index]['player'] = $record->user;
        return $records;
    }
}
