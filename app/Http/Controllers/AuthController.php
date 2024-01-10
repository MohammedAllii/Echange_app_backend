<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laracasts\Flash\Flash;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        // Validation
        $attributes = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:users,email'],
            'phone' => ['required', 'string'],
            'password' => ['required']
        ]);

        // Create user
        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone' => $attributes['phone'],
            'password' => bcrypt($attributes['password'])
        ]);

        // Return user & token in response
        return response([
            'user' => $user,
            'token' => $user->createToken('api_token')->plainTextToken
        ], 200);
    }

    // Login
    public function login(Request $request)
    {
        // Validation
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => ['required']
        ]);

        // Attempt login
        if (!Auth::attempt($attributes)) {
            
            return response(['message' => "Invalid credentials"], 403);
        }

        // Return user & token in response
        $user = auth()->user();
        $token = $user->createToken('api_token')->plainTextToken;
        session()->flash('success', 'Login successful!');

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    //Admin login
    public function loginAdmin(Request $request)
    {
        // Validation
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => ['required']
        ]);
    
        // Attempt login
        if (!Auth::attempt($attributes)) {
            session()->flash('error', 'Invalid credentials');
            return response(['message' => "Invalid credentials"], 403);
        }
    
        // Check user role
        $user = auth()->user();
    
        // Return user & token in response
        $token = $user->createToken('api_token')->plainTextToken;
        session()->flash('success', 'Login successful!');
    
        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }
    

    // Logout
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success.'
        ], 200);
    }

    // Get user details
    public function me()
    {
        return response()->json(auth()->user());
    }

    //get all users not banned
    public function getAllusersNotBan()
{
    $users = User::where('status','1')->where('role',0)->get();
    return view('ban', compact('users'));
}
    //open user 
    public function openUser($userId)
{
    try {
        $user = User::findOrFail($userId);
        $user->status = "1";
        $user->save();

        // Flash a success message
        Flash::success('User status updated successfully');

        return response()->json(['message' => 'User status updated successfully'], 201);
    } catch (\Exception $e) {
        // Flash an error message
        Flash::error('User not found or status update failed');

        return response()->json(['error' => 'User not found or status update failed'], 404);
    }
}

    //ban user 
    public function banUser($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->status = "0";
            $user->save();

            return response()->json(['message' => 'User status updated successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not found or status update failed'], 404);
        }
    }

    // Get user details with id
    public function getUserDetails($userid)
    {
        $user = User::where('id', $userid)->first();
        return response()->json($user);
    }

    public function banUserRoute()
    {
        return view('ban');
    }

    public function notBanUserRoute()
    {
        return view('notban');
    }

    //get all users not banned
    public function getAllusersBan()
{
    $users = User::where('status','0')->where('role',0)->get();
    return view('notban', compact('users'));
}

// Update Phone Number with User ID
public function updatePhone($userId, Request $request)
{
    $request->validate([
        'phone' => 'required|string|max:8',]);

    try {
        // Find the user by ID
        $user = User::find($userId);

        // Check if the authenticated user is updating their own phone number
        if (!$user) {
            return response(['error' => 'user not exist'], 401);
        }

        // Update user's phone number
        $user->phone = $request->input('phone');
        $user->save();

        // Return updated user in response
        return response([
            'user' => $user,
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'User not found or phone update failed'], 404);
    }
}

}
