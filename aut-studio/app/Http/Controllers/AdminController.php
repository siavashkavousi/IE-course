<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('admin', ['games' => $games]);
    }

    public function createGame()
    {
        return view('create-game');
    }

    public function create(Request $request)
    {
        $game = new Game();
        $game->title = $request->title;
        $game->abstract = $request->abstract;
        $game->info = $request->info;
        $game->large_image = $request->large_image;
        $game->small_image = $request->small_image;
        $game->save();

        return redirect()->route('games');
    }

    public function editGame($id)
    {
        $game = Game::find($id);
        return view('edit-game', ['game' => $game]);
    }

    public function edit(Request $request,$id)
    {
        $game = Game::find($id);
        $game->title = $request->title;
        $game->abstract = $request->abstract;
        $game->info = $request->info;
        $game->large_image = $request->large_image;
        $game->small_image = $request->small_image;
        $game->save();

        return redirect()->route('games');
    }

    public function delete($id)
    {
        Game::destroy($id);

        return redirect()->route('games');
    }
}
