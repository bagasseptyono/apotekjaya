<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function loginForm(){
        return view('auth.login');
    }

    public function registerForm(){
        return view('auth.register');
    }


    public function login(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Login success');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string',
            'gender' => 'required',
            'address' => 'required|string',
            'city' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'address' => $request->address,
            'city' => $request->city,
            'role' => 'user',
            'password' => Hash::make($request->password),
        ]);

        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Silahkan Login');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/login')->with('success', 'Anda Telah Logout');
    }
}
