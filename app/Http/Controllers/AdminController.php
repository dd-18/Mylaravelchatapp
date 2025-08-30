<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat; // or Message, depending on your DB

class AdminController extends Controller
{
    /**
     * Dashboard Overview
     */
    public function dashboard()
    {
        $usersCount   = User::count();
        $messagesCount = Chat::count();
        $onlineUsers  = User::where('is_online', 1)->count();

        return view('admin.dashboard', compact('usersCount', 'messagesCount', 'onlineUsers'));
    }

    /**
     * Manage Users
     */
    public function users()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Manage Messages
     */
    public function messages()
    {
        $messages = Chat::with(['user', 'recipient']) // load sender & recipient
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.messages', compact('messages'));
    }

    /**
     * Toggle User Block/Unblock
     */
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = !$user->is_blocked; // flip status
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    /**
     * Delete a Message
     */
    public function deleteMessage($id)
    {
        $msg = Chat::findOrFail($id);
        $msg->delete();

        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}
