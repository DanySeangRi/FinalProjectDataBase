<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt($credentials, $request->remember)) {

            $request->session()->regenerate();

            return redirect('/dashboard');
        }


        return back()->withErrors([
            'email' => 'Invalid email or password.'
        ]);
    }




    // Register
public function register(Request $request)
{
    $validated = $request->validate([

        'first_name' => 'required|string|max:255',

        'last_name' => 'required|string|max:255',

        'email' => 'required|email|unique:users,email',

        'phone' => 'required|string|max:20',

        'password' => 'required|min:8|confirmed',

    ]);


    $user = User::create([

        'first_name' => $validated['first_name'],

        'last_name' => $validated['last_name'],

        'email' => $validated['email'],

        'phone_number' => $validated['phone'],

        'password' => Hash::make($validated['password']),

    ]);


    Auth::login($user);


    $request->session()->regenerate();


    return redirect('/login');
}



    // Logout
    public function logout(Request $request)
    {

        Auth::logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();


        return redirect('/login');

    }
}