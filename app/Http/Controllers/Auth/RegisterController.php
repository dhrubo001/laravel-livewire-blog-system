<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function getRegister()
    {
        $title = "Register";
        return view('pages.auth.register', compact('title'));
    }

    public function postRegister(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Hash::make($validated['password']),
            'role' => 'user',
        ]);


        Auth::login($user);

        // // Redirect based on role
        // if ($user->isAdmin()) {
        //     return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        // }

        return redirect()->route('getDashboard')->with('success', 'Registration successful!');
    }
}
