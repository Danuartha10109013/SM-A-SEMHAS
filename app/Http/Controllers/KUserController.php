<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KUserController extends Controller
{
    public function index (){
        $bagian = Auth::user()->type;
        $data = User::where('type', $bagian)->get();
        return view('user.index',compact('data'));
    }

    public function store(Request $request)
    {
        $type = Auth::user()->type;
        // dd($request->all());
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|integer',
            'username' => 'required|string|max:255|unique:users,username',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle avatar upload
        // Handle avatar upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = $request->username . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store the avatar in the 'avatars' directory with the custom name
            $avatarPath = $file->storeAs('avatars', $name, 'public');
            
            // Debugging to check the stored path
            // dd($avatarPath);  // Check if the path is generated correctly
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'type' => $type,
            'password' => Hash::make('Tatametal123'), // Replace with the actual password logic
            'role' => $request->input('role'),
            'status' => 1,
            'profile' => $avatarPath, // This should be the generated path
        ]);
        

        // Redirect back with a success message
        return redirect()->route('kelola-user')->with('success', 'User added successfully.');
    }

    public function edit($id){
        $data = User::find($id);
        return view('user.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Exclude current user
            'role' => 'required|integer',
            'username' => 'required|string|max:255|unique:users,username,' . $id, // Exclude current user
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user data
        
        if($request->password == null){
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->role = $request->input('role');
        }else{
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->role = $request->input('role');
            $user->password = Hash::make( $request->input('password'));
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete the old avatar if it exists
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }

            // Get the uploaded file
            $file = $request->file('avatar');

            // Create a custom name for the avatar
            $name = $request->username . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store the avatar in the 'avatars' directory with the custom name
            $avatarPath = $file->storeAs('avatars', $name, 'public');
            
            // Assign the new path to the user
            $user->profile = $avatarPath;
        }

        // Save the updated user
        $user->save(); // Use save instead of update

        // Redirect back with success message
        return redirect()->route('kelola-user')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the avatar if it exists
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }

        // Delete the user
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('kelola-user')->with('success', 'User deleted successfully!');
    }


}

