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

            return redirect('/');
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
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'first_name' => 'required|string|max:255',

            'last_name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'phone' => 'required|string|max:20',

            'password' => 'required|min:8|confirmed',

        ]);


        User::create([

            'first_name' => $validated['first_name'],

            'last_name' => $validated['last_name'],

            'email' => $validated['email'],

            'phone_number' => $validated['phone'],

            'password' => Hash::make($validated['password']),

        ]);


        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'User created successfully.']);
        }

        return redirect()
            ->route('admin.users')
            ->with('success', 'User created successfully.');
    }
    // List + search users
    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = User::query()
            ->where('role', 'user')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        if ($request->ajax() || $request->wantsJson()) {
            return view('admin.users._rows', compact('users'))->render();
        }

        return view('admin.users.index', compact('users', 'search'));
    }
    // Update user
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([

            'first_name' => 'required|string|max:255',

            'last_name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'phone_number' => 'nullable|string|max:20',

        ]);


        $user->update($validated);


        return response()->json([
            'message' => 'User updated successfully.'
        ]);
    }



    // Delete user
    public function destroy(User $user)
    {
        $user->delete();


        return response()->json([
            'message' => 'User deleted successfully.'
        ]);
    }
    public function bookingHistory($id)
    {

        $user = User::findOrFail($id);
        $bookings = $user->bookings()->with(['routeSchedule.route'])->latest()->paginate(10);

        return view(
            'admin.users.booking-history',
            compact('user', 'bookings')
        );
    }



}