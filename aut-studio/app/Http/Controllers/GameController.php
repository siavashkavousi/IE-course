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
        return makeSuccessResponse(['game' => filterGame($game)]);
    }

    public function info($title)
    {
        $game = Game::where('title', $title)->first();
        return makeSuccessResponse(['game' => filterGame($game)]);
    }

    public function leaderboard($title)
    {
        $game = Game::where('title', $title)->first();
        $records = Record::where('game_id', $game->id)->get();
        return makeSuccessResponse(['leaderboard' => $this->filterRecords($records)]);
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
        return makeSuccessResponse(['games' => $values]);
    }

    private function filterRecords($records)
    {
        $result = $records->toArray();
        foreach ($records as $index => $record) {
            $result[$index]['player'] = filterPlayer($record->player);
            $result[$index] = array_except($result[$index], ['id', 'game_id', 'player_id']);
        }
        return $result;
    }
}
