<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login()
    {
        //dd(Auth::check());
        if(Auth::check()){
            return redirect()->intended(route('landing_page'));
        }

        return view('Admin.login', [
            'title' => 'Admin'
        ]);
    }

    public function login_post(Request $req)
    {
        
        $req->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $credentials = $req->only('name', 'password');
        if(Auth::guard('admins')->attempt($credentials)){
            return redirect()->intended(route('admin.home'));       
        }
        dd(Auth::check());
        return redirect(route('admin_login'))->with("error", "Login invalid");
    }

    public function register(){
        return view('Admin.register', [
            'title' => 'Register'
        ]);
    }

    public function register_post(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $data['name'] = $req->name;
        $data['password'] = Hash::make($req->password);
        $user = Admin::create($data);

        if(!$user)
        {
            return redirect(route('landing_page'))->with("error", "Failed");
        }
        return redirect(route('admin_login'))->with("success", "Success");

    }

    public function index()
    {
        $jobs = Job::all();
        $company = Company::all();

        return view('Admin.home', [
            'title' => 'admins',
            'jobs' => $jobs,
            'company' => $company,
        ]);
    }

    
}
