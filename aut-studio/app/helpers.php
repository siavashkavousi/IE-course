<?php

use App\Game;
use App\Libraries\IntlDateTime;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

function load_json($filename)
{
    if (Storage::exists($filename . '.json'))
        return json_decode(Storage::get($filename . '.json'), true);
    else
        throw new FileNotFoundException("file $filename does not exists");

}

function attach_timestamps($data)
{
    foreach ($data as $index => $item)
        $data[$index] = array_merge($item, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    return $data;
}

function make_success_response($data)
{
    return ['ok' => true, 'result' => $data];
}

function filter_games($games)
{
    foreach ($games as $index => $game)
        $games[$index] = filter_game($game);
    return $games;
}

function filter_game(Game $game)
{
    $game['categories'] = get_categories($game);
    return $game;
}

function get_categories(Game $game)
{
    $categories = $game->categories;
    $list = filter_categories($categories);
    $game->setRelations([]);
    return $list;
}

function filter_categories($categories)
{
    $list = [];
    foreach ($categories as $category)
        array_push($list, $category->name);
    return $list;
}

function filter_comments($comments)
{
    foreach ($comments as $index => $comment) {
        $date = new IntlDateTime(new DateTime($comment->date), 'Asia/Tehran', 'persian', 'fa');
        $comments[$index]['date'] = $date->format('E dd LLL yyyy');
        $comments[$index]['game'] = filter_game($comment->game);
        $comments[$index]['player'] = $comment->user;
    }
    return $comments;
}