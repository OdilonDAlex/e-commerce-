<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    
    public function index() {
        return view('chat.index', [
            'users' => User::where('id', '!=', Auth::user()->id)->get(),
        ]);
    }

    public function create(Request $request) {
        return json_encode(['status' => 403]);
    }
}
