<?php

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

function addInitialData($table_name)
{
    $list = loadJSON($table_name . '.json');
    foreach ($list as $item) {
        DB::table($table_name)->insert(
            array_merge($item, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()])
        );
    }
}