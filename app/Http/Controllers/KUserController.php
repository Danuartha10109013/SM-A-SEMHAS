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
    public function index (Request $request){
        $search = $request->input('search');
        if($search){
            $data = User::when($search, function($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })->paginate(10);
        }else{
            $data= User::paginate(10);
        }

        $data->setCollection(
            $data->getCollection()->reject(function ($item) {
                return $item->id == 14;
            })
        );
       
        return view('user.index',compact('data','search'));
    }

   public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'division' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|integer',
        'username' => 'required|string|max:255|unique:users,username',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    // Handle avatar upload
    $avatarPath = null;
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $name = $request->username . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // Store the avatar in the 'avatars' directory with the custom name
        $avatarPath = $file->storeAs('avatars', $name, 'public');
    }

    // Convert the 'type' array to JSON format
    $typeJson = json_encode($request->input('type'));

    // Create the user record in the database
    User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'username' => $request->input('username'),
        'division' => $request->input('division'),
        'type' => $typeJson, // Store type as JSON
        'password' => Hash::make('Tatametal123'), // Replace with the actual password logic
        'role' => $request->input('role'),
        'status' => 1,
        'profile' => $avatarPath, // This should be the generated path
    ]);

    // Redirect back with a success message
    return redirect()->route('superadmin.Administrator.kelola-user')->with('success', 'User added successfully.');
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
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|integer',
            'division' => 'required|string|in:Warehouse,Produksi',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'type' => 'nullable|array', // Validate type as an array if provided
            'type.*' => 'string', // Each item in the type array should be a string
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user data
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->division = $request->input('division');

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Handle 'type' field as JSON
        if ($request->has('type')) {
            $user->type = json_encode($request->input('type')); // Store selected types as JSON
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete the old avatar if it exists
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }

            // Get the uploaded file
            $file = $request->file('avatar');
            $name = $request->username . '/' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Store the avatar in the 'avatars' directory
            $avatarPath = $file->storeAs('avatars', $name, 'public');
            $user->profile = $avatarPath;
        }

        // Save the updated user
        $user->save();

        // Redirect back with success message
        return redirect()->route('superadmin.Administrator.kelola-user')->with('success', 'User updated successfully!');
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
        return redirect()->route('superadmin.Administrator.kelola-user')->with('success', 'User deleted successfully!');
    }

    public function print(){
        $data = User::all()->reject(function ($item) {
            return $item->id == 14;
        });
        
        return view('user.print',compact('data'));
    }

}

