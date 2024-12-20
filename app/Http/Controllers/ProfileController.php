<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index($id){
        $data = User::find($id);
        return view('profile.index',compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Validate request inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validation for profile image
        ]);
    
        // Find user by ID
        $user = User::find($id);
    
        // Update user information
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        // $user->role = $request->role; // Add role field
        // $user->type = $request->type; // Add type field
    
        // Check if a new password is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            if ($user->profile && Storage::exists($user->profile)) {
                Storage::delete($user->profile);
            }
    
            // Store the new profile image with a custom name
            $date = $request->username;
            $file = $request->file('avatar');
            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
    
            // Store the file in the 'avatars' directory with the custom name
            $path = $file->storeAs('avatars', $name, 'public');
    
            // Save the new profile image path in the database
            $user->profile = $path;
        }
    
        // Save updated user
        $user->update();
    
        // Redirect with a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    
}