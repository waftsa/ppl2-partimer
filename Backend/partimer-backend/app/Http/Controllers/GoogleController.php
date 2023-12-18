<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->getId())->first();

            if($finduser){
                Auth::guard('web')->login($finduser);
                //dd(Auth::check());
                return redirect()->intended(route('user_homepage'));
            }else{
                
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make(Str::random(20))
                ]);

                //Auth::guard('web')->login($newUser);
            return redirect(route('login_google'))->with("success", "Login Success");               
            }

        } catch (Exception $th) {
            // dd($th->getMessage());
        }
    }
}
