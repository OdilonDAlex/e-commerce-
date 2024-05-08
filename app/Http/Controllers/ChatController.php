<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ChatController extends Controller
{
    
    public function index() {
        return view('chat.index', [
            'users' => User::where('id', '!=', Auth::user()->id)->get(),
        ]);
    }

    public function create(Request $request) {
        
        $message_data = $request->validate([
            'content' => ['required', 'string', ],
            'receiver_id' => ['required', 'integer'],
        ]);

        $receiver = null;
        $message = null;
        
        try {
            $receiver = User::findOrFail($message_data['receiver_id']);
            $message = Auth::user()->messages()->create([
                'content' => $message_data['content'],
                'send_at' => Carbon::now(),
                'receiver_id' => $message_data['receiver_id'],
            ]);
        }
        catch(Exception $e) {
            throw ValidationException::withMessages([
                'receiver_id' => 'Receiver_id error',
                'error' => $e->getMessage(),
            ]);
        }

        event(new MessageSent($message, $receiver->id));
        return json_encode(['status' => 200]);
    }

}
