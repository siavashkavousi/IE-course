<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Game;
use App\Libraries\IntlDateTime;
use App\Tutorial;
use DateTime;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        if (auth()->check() && !auth()->user()->categories->isEmpty())
            $popularGames = $this->getUserFavoriteGames();
        else
            $popularGames = $this->getPopularGames(Category::all());

        $latestGames = Game::take(10)->get();
        $latestComments = Comment::take(5)->get();
        $latestTutorials = Tutorial::take(5)->get();

        $response = ['ok' => true, 'result' =>
            ['homepage' => ['slider' => $this->filterGames($popularGames),
                'new_games' => $this->filterGames($latestGames),
                'comments' => filter_comments($latestComments),
                'tutorials' => $this->filterTutorials($latestTutorials)]
            ]];
        return $response;
    }

    public function getPopularGames($categories)
    {
        $popularGames = [];
        foreach ($categories as $category) {
            $gamesInCategory = $category->games->sortByDesc('rate')->take(5)->all();
            foreach ($gamesInCategory as $item)
                $popularGames = array_add($popularGames, $item['title'], $item);
        }
        list($keys, $popularGames) = array_divide($popularGames);
        return $popularGames;
    }

    public function getUserFavoriteGames()
    {
        return $this->getPopularGames(auth()->user()->categories);
    }

    private function filterGames($games)
    {
        foreach ($games as $index => $game)
            $games[$index] = filter_game($game);
        return $games;
    }

    private function filterTutorials($tutorials)
    {
        foreach ($tutorials as $index => $tutorial) {
            $date = new IntlDateTime(new DateTime($tutorial->date), 'Asia/Tehran', 'persian', 'fa');
            $tutorials[$index]['date'] = $date->format('E dd LLL yyyy');
            $tutorials[$index]['game'] = filter_game($tutorial->game);
        }
        return $tutorials;
    }
}
