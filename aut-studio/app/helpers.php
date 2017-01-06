<?php

use App\Game;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

function loadJSON($filename)
{
    if (Storage::exists($filename)) {
        return json_decode(Storage::get($filename), true);
    } else {
        throw new FileNotFoundException("file $filename does not exists");
    }
}

function addInitialData($table_name, $hasTimestamps = true)
{
    $list = loadJSON($table_name . '.json');
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

function makeSuccessResponse($data)
{
    return ['ok' => true, 'result' => $data];
}

function filterGame(Game $game)
{
    $result = $game->toArray();
    $result['categories'] = getCategories($game);
    return array_except($result, 'id');
}

function getCategories(Game $game)
{
    $list = [];
    $categories = $game->categories;
    foreach ($categories as $category)
        array_push($list, $category->name);
    return $list;
}