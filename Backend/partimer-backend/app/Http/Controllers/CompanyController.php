<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function login(){

        if(Auth::guard('company')->check()){
            return redirect()->intended(route('company_homepage'));
        }

        return view('Company.login', [
            'title' => 'Login'
        ]);
    }

    public function login_post(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $req->only('email', 'password');
        if(Auth::guard('company')->attempt($credentials)){ 
            return redirect()->intended(route('company_homepage'))->with('success','You are Logged in sucessfully.');
        }
        return back()->with('error','Whoops! invalid email and password.');
    }

    public function register(){

        if(Auth::check()){
            return redirect()->intended(route('company_homepage'));
        }

        return view('Company.register', [
            'title' => 'Register'
        ]);
    }

    function register_post(Request $req)
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
        $data['verified'] = 1;
        $user = Company::create($data);

        if(!$user)
        {
            return redirect(route('company_register'))->with("error", "Registration Failed, try again");
        }

        return redirect(route('company_login'))->with("success", "Registration Successfull, Waiting For Approval");
    }

    public function index()
    {
        if(!Auth::guard('company')){
            return redirect(route('login'));
        }

        $jobs = Job::all();
        return view('Job.index_company', [
            'title' => 'job',
            'jobs' => $jobs,
            compact('jobs')
        ]);
    }
}
