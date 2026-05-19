<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'string'],
            'password' => ['required'],
        ]);

        $login    = $request->input('email'); // field is named 'email' in the form
        $password = $request->input('password');

        // Determine whether the input looks like an email or a username
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $login, 'password' => $password])) {
            $request->session()->regenerate();
            $request->session()->put('name', Auth::user()->name);
            $request->session()->put('role', Auth::user()->role);
            return redirect()->intended('/dashboard');
        }

        return back()->with('login_error', 'Email/username atau password salah.')->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => ['required', 'min:6', 'confirmed'],
            'email' => ['required', 'email'],
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route('login');
    }
}
