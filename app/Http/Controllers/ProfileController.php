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
        // dd($request->all());
        // Validate request inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for profile image
        ]);

        // Find user by ID
        $user = User::findOrFail($id);

        // Update user information
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        // Check if a new password is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            if ($user->profile && Storage::exists($user->profile)) {
                // Delete the old avatar if it exists
                Storage::delete($user->profile);
            }
            
            // Store the new profile image with a custom name
            $date = $request->username;
            $file = $request->file('avatar'); // Get the file
            $name = $date . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store the file in the 'avatars' directory with the custom name
            $path = $file->storeAs('avatars', $name, 'public');
            
            // Save the new profile image path in the database
            $user->profile = $path;
            

        // Save updated user
        $user->save();

        // Redirect with a success message
        return redirect()->route('profile',$id)->with('success', 'Profile updated successfully!');
    }
}
}