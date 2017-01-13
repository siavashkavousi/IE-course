<?php

namespace App\Providers;

use App\Comment;
use Illuminate\Support\ServiceProvider;

class DatabaseListenerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Comment::creating(function ($comment) {
            $comment->game->increment('number_of_comments');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
