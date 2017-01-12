<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Game;
use App\Record;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $comments = array_slice($comments->toArray(), $offset, 2);

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

    public function submitComment(Request $request, $title)
    {
        $game = Game::where('title', $title)->first();
        if (Auth::check()) {
            $content = json_decode($request->getContent(), true);
            if (array_key_exists('text', $content) && array_key_exists('rate', $content)) {
                $comment = new Comment();
                $comment->text = $content['text'];
                //TODO should fix date in all models
                $comment->date = Carbon::now();
                $comment->rate = $content['rate'];
                $comment->user()->associate(Auth::user());
                $comment->game()->associate($game);
                $comment->save();
            }
        } else {
            abort(301, "Unauthorized Action");
        }
    }

    private function filterRecords($records)
    {
        foreach ($records as $index => $record) {
            $records[$index]['player'] = $record->user;
            $record->setRelations([]);
        }
        return $records;
    }
}
