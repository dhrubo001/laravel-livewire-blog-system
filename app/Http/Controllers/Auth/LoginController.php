<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        $title = "Login";
        return view('pages.auth.login', compact('title'));
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->filled('remember');


        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();


            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
            }

            return redirect()->route('getDashboard')->with('success', 'Welcome back!');
        }

        //  Authentication failed
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    public function postLogout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate and regenerate the session to prevent session fixation
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page with flash message
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}