<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Game;
use App\Record;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('game'))
            return view('game');
        elseif ($request->input('q'))
            return $this->queryOnGames($request->input('q'));
        else
            return abort(404, 'Not Found');
    }

    public function game($title)
    {
        if ($title == 'بازی مین روب')
            return view('games.minesweeper');
        else
            return view('errors.503');
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
        $records = Record::where('game_id', $game->id)->orderBy('score', 'desc')->take(10)->get();
        if (auth()->check()) {
            $user_record = Record::where('user_id', auth()->user()->id)->get();
            if (!$user_record->isEmpty() && $records->last()->score > $user_record[0]->score) {
                $records->push($user_record[0]);
                return make_success_response(['leaderboard' => $this->filterRecords($records)]);
            }
        }
        return make_success_response(['leaderboard' => $this->filterRecords($records)]);
    }

    public function comments(Request $request, $title)
    {
        $game = Game::where('title', $title)->first();
        $comments = Comment::where('game_id', $game->id)->get();

        $offset = $request->query('offset');
        $comments = filter_comments($comments);
        $comments = array_slice($comments->toArray(), $offset, 2);

        if (auth()->check()) {
            $user_comment = Comment::where('user_id', auth()->user()->id)->first();

            if ($user_comment)
                return make_success_response(['commented' => true, 'comments' => $comments]);
        }
        return make_success_response(['comments' => $comments]);
    }

    public function relatedGames($title)
    {
        $game = Game::where('title', $title)->first();
        $relatedGames = [];
        foreach ($game->categories as $category) {
            $gamesInCategory = filter_games($category->games);
            foreach ($gamesInCategory as $item) {
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
        if (auth()->check() && $game) {
            $lastComment = Comment::where('user_id', auth()->user()->id)->first();
            if ($lastComment)
                abort(400, 'User has already commented on this game');

            $content = json_decode($request->getContent(), true);
            if (array_key_exists('text', $content) && array_key_exists('rate', $content)) {
                $comment = new Comment();
                $comment->text = e($content['text']);
                $comment->date = Carbon::now();
                $comment->rate = e($content['rate']);
                $comment->user()->associate(auth()->user());
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

    public function games()
    {
        return view('games');
    }

    public function queryOnGames($query_string)
    {
        $games = Game::where('title', 'like', '%' . e($query_string) . '%')->get();
        return make_success_response(['games' => filter_games($games)]);
    }

    public function submitRecord(Request $request, $title)
    {
        $game = Game::where('title', $title)->first();
        if (auth()->check() && $game) {
            $content = json_decode($request->getContent(), true);
            if (array_key_exists('record', $content)) {
                $lastRecord = Record::where('user_id', auth()->user()->id)->first();
                if ($lastRecord) {
                    $lastRecord->score = e($content['score']);
                    $lastRecord->save();
                } else {
                    $record = new Record();
                    $record->score = e($content['score']);
                    $record->level = 120;
                    $record->displacement = 5;
                    $record->user()->associate(auth()->user());
                    $record->game()->associate($game);
                    $record->save();
                }
            }
        } else {
            abort(301, "Unauthorized Action");
        }
    }
}
