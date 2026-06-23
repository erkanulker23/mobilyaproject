<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\Admin\ContactFormCreatedNotification;

class ContactFormSubmissionCreatedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        User::role(['admin', 'superadmin'])->get()->each(function ($user) use ($event) {
            $user->notify(new ContactFormCreatedNotification($event->contactForm));
        });
    }
}
