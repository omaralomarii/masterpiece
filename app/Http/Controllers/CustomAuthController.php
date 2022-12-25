<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
// use Hash;
// use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\Hash as FacadesHash;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('login');
    }
    public function profile()

    {
        $user = Auth::user();
        return view('Profile', ['user' => $user]);
    }


    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                ->withSuccess('Signed in');
        }

        return redirect("/login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('registration');
    }


    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required',
            'address' => 'required',
            'zip' => 'required'
        ]);

        $data = $request->all();
        $check =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'zip' => $data['zip'],

        ]);

        return redirect("login")->withSuccess('have signed-in');
    }





    public function dashboard()
    {
        if (Auth::check()) {
            return view('index');
        }

        return redirect("login")->withSuccess('are not allowed to access');
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
