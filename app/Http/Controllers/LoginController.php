<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function registration(){
        return view('manage-login.Registration');
    }

    public function postregistration(Request $request){
        $request->validate([
            'name' => 'required|unique:login_record',
            'email' => 'required|email|unique:login_record',
            'password' => 'required|min:5'
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if (!$user) {
            return redirect(route('manage-login.Registration'))->with("error", "Registration failed, please try again");
        }
        return redirect(route('login'))->with("success", "Successfully registered, please log in");
    }

    public function login() {
        if (Auth::check()) {
            return redirect(route('manage-note.IndexNote'));  // Redirect to 'manage-note' page if already logged in
        }
        return view('manage-login.Login');  // Show the login page if not authenticated
    }    

    public function postlogin(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('manage-note.IndexNote')->with('success', 'Logged in successfully');
        }
        return redirect(route('login'))->with("error", "Login credentials do not match our records");
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'))->with("success", "Successfully logged out");
    }
}
