<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function load404(){
        return view('404');
    }

    public function loadWelcome(){
        return view('welcome');
    }

    public function loadRegisterForm(){
        return view('register');
    }

    public function registerUser(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12|confirmed',
        ]);

        // als validatie is geslaagd
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make( $request->password );
            $user->save();

            $user_profile = new UserProfile;
            $user_profile->user_id = $user->id;
            $user_profile->save();

            return redirect('/registration/form')->with('success','You have registered successfully!');
        } catch (\Exception $e) {
            return redirect('/registration/form')->with('error',$e->getMessage());

        }
    }

    public function loadLoginForm(){
        return view('login');
    }

    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6|max:8',
        ]);

        try {
            // login logic here
            $userCredentials = $request->only('email','password');

            if(Auth::attempt($userCredentials)){
                if(auth()->user()->role == 0){
                    return redirect('/user/home');
                }elseif(auth()->user()->role == 1){
                    return redirect('/admin/home');
                }else{
                    return redirect('/')->with('error','Could not find your role');
                }

            }else{
                return redirect('/login/form')->with('error','Invalid credentials');
            }
        } catch (\Exception $e) {
            return redirect('/login/form')->with('error',$e->getMessage());
        }
    }

    public function logoutUser(Request $request){
        Session::flush();
        Auth::logout();
        return redirect('/login/form');
    }
}
