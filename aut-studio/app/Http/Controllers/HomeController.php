<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Game;
use App\Tutorial;

class HomeController extends Controller
{
    public function index()
    {
//        if (!Auth::check())
        return $this->indexWithoutAuth();
//        else
//            return null;
    }

    private function indexWithoutAuth()
    {
        $popularGames = Game::orderBy('rate', 'desc')->take(10)->get();
        $latestGames = Game::take(5)->get();
        $latestComments = Comment::take(5)->get();
        $latestTutorials = Tutorial::take(5)->get();

        $response = ['ok' => true, 'result' =>
            ['homepage' => ['slider' => $this->filterGames($popularGames),
                'new_games' => $this->filterGames($latestGames),
                'comments' => $this->filterComments($latestComments),
                'tutorials' => $this->filterTutorials($latestTutorials)]
            ]];
        return $response;
    }

    private function filterComments($comments)
    {
        $result = $comments->toArray();
        foreach ($comments as $index => $comment) {
            $result[$index]['game'] = $this->filterGame($comment->game);
            $result[$index]['player'] = $this->filterPlayer($comment->player);
            $result[$index] = array_except($result[$index], ['id', 'game_id', 'player_id']);
        }
        return $result;
    }

    private function filterGames($games)
    {
        $result = $games->toArray();
        foreach ($games as $index => $game) {
            $result[$index]['categories'] = $this->getCategories($game);
            $result[$index] = array_except($result[$index], 'id');
        }
        return $result;
    }

    private function filterGame($game)
    {
        $result = $game->toArray();
        $result['categories'] = $this->getCategories($game);
        return array_except($result, 'id');
    }

    private function filterPlayer($player)
    {
        return array_except($player, 'id');
    }

    private function filterTutorials($tutorials)
    {
        $result = $tutorials->toArray();
        foreach ($tutorials as $index => $tutorial) {
            $result[$index]['game'] = $this->filterGame($tutorial->game);
            $result[$index] = array_except($result[$index], 'id', 'game_id');
        }
        return $result;
    }

    private function getCategories(Game $game)
    {
        $list = [];
        $categories = $game->categories;
        foreach ($categories as $category)
            array_push($list, $category->name);
        return $list;
    }
}
