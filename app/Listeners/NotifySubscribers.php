<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubscribers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ThreadCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        var_dump($event->post['title'] . ' was published');
        // TODO: Could do something more interesting, e.g. email subscribers,
        // with a link to the post.
        Mail::to(User::all())->send(new \App\Mail\PostBroadcast($event->post));
    }
}
