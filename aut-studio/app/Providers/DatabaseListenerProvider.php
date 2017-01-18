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
            $num_comments = $comment->game->number_of_comments;
            if ($num_comments == 0)
                $comment->game->update(['rate' => $comment->rate]);
            else
                $comment->game->update(['rate' => ($num_comments * $comment->game->rate + $comment->rate) / ($num_comments + 1)]);
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
