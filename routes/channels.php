<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

/** add the rule for subscribing 'messages' chanel */
Broadcast::channel('messages', function ($user) {
    return true; //every logged-in user is allowed to subscribe this chanel
});
