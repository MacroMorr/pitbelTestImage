<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'User registration';
        return view('register', $data);
    }

    public function registerAction(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:user',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->username),
        ]);
        $user->save();
        return redirect()->route('login')->with('success', 'Registration success. Please Login!');
    }

    public function login()
    {
        $data['title'] = 'login';
        return view('login', $data);
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors(['password', 'Wrong username or password']);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('password', $data);
    }

    public function passwordAction(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
