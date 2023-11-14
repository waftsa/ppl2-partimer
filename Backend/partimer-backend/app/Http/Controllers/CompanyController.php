<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class CompanyController extends Controller
{
    public function login(){

        if(auth()->guard('company')->check()){
            return redirect()->intended(route('companyHompage'));
        }

        return view('Auth.CompanyAuth.loginComp', [
            'title' => 'Login'
        ]);
    }

    public function loginPost(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $req->only('email', 'password');
        if(Auth::guard('company')->attempt($credentials)){ 
            return redirect()->intended(route('companyHomepage'))->with('success','You are Logged in sucessfully.');
        }
        return back()->with('error','Whoops! invalid email and password.');
    }

    public function register(){

        if(Auth::check()){
            return redirect()->intended(route('companyHompage'));
        }

        return view('Auth.CompanyAuth.registerComp', [
            'title' => 'Register'
        ]);
    }

    function registerPost(Request $req)
    {
        $req->validate([
            'companyName' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'password_confirm' => 'required|same:password'
        ]);

        $data['companyName'] = $req->companyName;
        $data['address'] = $req->address;
        $data['email'] = $req->email;
        $data['password'] = Hash::make($req->password);
        $user = Company::create($data);

        if(!$user)
        {
            return redirect(route('user.register_comp'))->with("error", "Registration Failed, try again");
        }

        return redirect(route('user.login_comp'))->with("success", "Registration Successfull, Waiting For Approval");
    }

    function logout(){
        auth()->guard('company')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('user.login_comp'));
    }
}
