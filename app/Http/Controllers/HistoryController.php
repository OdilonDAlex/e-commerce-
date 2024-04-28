<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        /** @var User $authenticatedUser */
        $authenticatedUser = Auth::user() ;
        return view('history', [
            'notifications' => $authenticatedUser->unReadNotifications()->paginate(25),
        ]);
    }
}
