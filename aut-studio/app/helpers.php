<?php

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

function loadJSON($filename)
{
    if (Storage::exists($filename)) {
        return json_decode(Storage::get($filename), true);
    } else {
        throw new FileNotFoundException("file $filename does not exists");
    }
}