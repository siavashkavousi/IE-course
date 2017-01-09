<?php

use App\Game;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

function load_json($filename)
{
    if (Storage::exists($filename)) {
        return json_decode(Storage::get($filename), true);
    } else {
        throw new FileNotFoundException("file $filename does not exists");
    }
}

function addInitialData($table_name, $hasTimestamps = true)
{
    $list = load_json($table_name . '.json');
    if ($hasTimestamps) {
        foreach ($list as $item) {
            DB::table($table_name)->insert(
                array_merge($item, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()])
            );
        }
    } else {
        DB::table($table_name)->insert($list);
    }
}

function make_success_response($data)
{
    return ['ok' => true, 'result' => $data];
}

function filter_game(Game $game)
{
    $game['categories'] = get_categories($game);
    return $game;
}

function get_categories(Game $game)
{
    $list = [];
    $categories = $game->categories;
    foreach ($categories as $category)
        array_push($list, $category->name);
    $game->setRelations([]);
    return $list;
}

function filter_comments($comments)
{
    foreach ($comments as $index => $comment) {
        $comments[$index]['game'] = filter_game($comment->game);
        $comments[$index]['player'] = $comment->player;
    }
    return $comments;
}