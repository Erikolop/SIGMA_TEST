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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Set session variables used by the layout sidebar
            $request->session()->put('name', Auth::user()->name);
            $request->session()->put('role', Auth::user()->role);
            return redirect()->intended('/dashboard');
        }

        return back()->with('login_error', 'Email atau password salah.')->onlyInput('email');
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
