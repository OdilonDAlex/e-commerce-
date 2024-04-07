<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-{id_1}-{id_2}', function(User $user, $id_1, $id_2) {
    return (int) $user->id === (int) $id_1 || (int) $user->id === (int) $id_2; 
});