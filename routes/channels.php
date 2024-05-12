<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-{id_1}-{id_2}', function(User $user, $id_1, $id_2) {
    return (int) $user->id === (int) $id_1 || (int) $user->id === (int) $id_2; 
});

Broadcast::channel('user-{id}-add-product-to-cart', function(User $user, $id) {
    return (int) $user->id === (int) $id;
}) ;

Broadcast::channel('reload-listener', function(User $user){
    return $user->role == "admin";
});