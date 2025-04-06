<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // This is where your login view will be rendered
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the login form
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('login')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Attempt to log the user in
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // If successful, redirect to the intended page (or dashboard)
            return redirect()->intended('/dashboard'); // Change this to your desired route
        }

        // If authentication fails
        return redirect('login')
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput();
    }

    // Logout the user
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
