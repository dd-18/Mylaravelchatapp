<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;

class AdminController extends Controller
{
    // Dashboard Overview
    public function dashboard()
    {
        $usersCount = User::count();
        $messagesCount = Chat::count();
        $onlineUsers = User::where('is_online', 1)->count();

        return view('admin.dashboard', compact('usersCount', 'messagesCount', 'onlineUsers'));
    }

    // List Users
    public function users()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.users', compact('users'));
    }

    // Block/Unblock User
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = !$user->is_blocked; // toggle status
        $user->save();

        return back()->with('success', 'User status updated successfully!');
    }

    // List Messages
    public function messages()
    {
        $messages = Chat::with(['user', 'recipient'])->orderBy('id', 'desc')->paginate(20);
        return view('admin.messages', compact('messages'));
    }

    // Delete Message
    public function deleteMessage($id)
    {
        $message = Chat::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Message deleted successfully!');
    }
}
