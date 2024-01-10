<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/welcome';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Attempt login
        if (Auth::attempt($credentials)) {
            // Check user role
            $user = Auth::user();
            if ($user->role == 1) {
                // Successful login
                $this->sendLoginResponse($request);
                // Flash success message to session
                session()->flash('success', 'Login successful!');
                return response()->json(['message' => 'login  successfully', 'success' => true], 201);
            } else {
                // Logout the user and return false (not authorized)
                Auth::logout();
                return false;
            }
        }

        return false; // Login unsuccessful
    }
}
