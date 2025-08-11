<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $id = null)
    {
        $messages = [];
        $otherUser = null;
        $user_id = Auth::id();

        if ($id) {
            $otherUser = User::findOrFail($id);
            $group_id = ($user_id > $id)
                ? $user_id . $id
                : $id . $user_id;

            $messages = Chat::where('group_id', $group_id)
                ->orderBy('created_at', 'asc')
                ->get()
                ->toArray();

            Chat::where([
                'user_id' => $id,
                'other_user_id' => $user_id,
                'is_read' => 0
            ])->update(['is_read' => 1]); 
        }

        $friends = User::where('id', '!=', $user_id)
            ->select('*', DB::raw("
            (SELECT COUNT(id) FROM chats 
             WHERE chats.other_user_id = $user_id 
               AND chats.user_id = user_id 
               AND is_read = 0) as unread_message
        "))
            ->get();

        // dd($friends);

        return view('home', compact('friends', 'messages', 'otherUser', 'id'));
    }
}
