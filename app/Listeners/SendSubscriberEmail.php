<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;





class SendSubscriberEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSubscribed $event): void
    {



        // Send the email to the user
        Mail::raw('Thank you for subscribing!', function ($message) use ($event) {
            $message->to($event->user->email);
            $message->subject('Welcome to our newsletter!');
        });
    }
}
