<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserContoller extends Controller
{
    public function create(){
        return view('users.register');
    }

    //Store controller
    public function store(Request $request){
        $formField = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        // Hash Password
        $formField['password'] = bcrypt($formField['password']);
        
        //create user
        $user = User::create($formField);

        //login
        auth()->login($user);

        return redirect('/')->with('message','User Created and login');

    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','You have been logged out');
    }

    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formField = $request->validate([
            'email' => 'required|email',
            'password' => ['required', 'min:8']
        ]);

        if(auth()->attempt($formField)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
