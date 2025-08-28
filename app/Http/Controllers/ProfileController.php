<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password'   => 'nullable|string|min:8|confirmed',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find(Auth::id());

        // Update basic info
        $user->name  = $request->name;
        $user->email = $request->email;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Handle uploaded profile image
        if ($request->hasFile('user_image')) {
            // Delete old image if it exists
            if ($user->user_image && Storage::disk('public')->exists('users/' . $user->user_image)) {
                Storage::disk('public')->delete('users/' . $user->user_image);
            }

            $image = $request->file('user_image');

            // Generate unique filename
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image using the public disk
            $image->storeAs('users', $imageName, 'public');

            // Update user record
            $user->user_image = $imageName;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}