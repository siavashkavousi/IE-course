<?php

namespace App\Http\Controllers;

use App\Game;

class HomeController extends Controller
{
    public function home()
    {
//        if (!Auth::check())
        return $this->homeWithoutAuth();
//        else
//            return null;
    }

    private function homeWithoutAuth()
    {
        $popularGames = Game::orderBy('rate', 'desc')->take(10)->get();
        $latestGames = Game::orderBy('created_at')->take(5)->get();
        $response = ['ok' => true, 'result' =>
            ['homepage' => ['slider' => $popularGames, 'new_games' => $latestGames]]];
        return $response;
    }
}
