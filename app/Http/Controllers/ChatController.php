<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{
    
    public function index() {

        if(! Gate::allows('visit-admin-pages')){
            return to_route('homepage');
        }
    
        return view('chat.index', [
            'users' => User::where('last_message_at', '!=', null)->orderByDesc('last_message_at')->get(),
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

        Auth::user()->last_message_at = Carbon::now();

        Auth::user()->save();

        event(new MessageSent($message, $receiver->id));

        return json_encode(['status' => 200]);
    }

}
