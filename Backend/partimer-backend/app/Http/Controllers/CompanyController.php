<?php

namespace App\Http\Controllers;

use App\Models\Applied_Job;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function homepage()
    {
        return view('Company.homepage', [
            'title' => "index",
        ]);
    }

    public function login(){

        if(Auth::check()){
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
            //dd(Auth::check());
            if(Auth::guard('company')->user()->verified){
                return redirect()->intended(route('company_homepage'))->with('success','You are Logged in sucessfully.');
            }
            else{
            Auth::logout();
            return back()->with('error','Email not verified');
            }
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
        $data['verified'] = 0;
        $user = Company::create($data);

        if(!$user)
        {
            return redirect(route('company_register'))->with("error", "Registration Failed, try again");
        }

        return redirect(route('company_login'))->with("success", "Registration Successfull, Waiting For Approval");
    }

    function profile(Company $company){
        return view('Company.profile',[
            'title' => 'Profile',
            'user' => $company,
        ]);
    }

    public function edit(Company $company)
    {
        return view('Company.edit',[
            'title' => 'edit',
            'user' => $company,
        ]);
    }

    public function update(Company $user,Request $req)
    {
        
        $req->validate([
            'phoneNum' => 'required|min:10',
            'email' => 'required|email',
            'description' => 'required',
            'address' => 'required',
            'updated_at' => now()
        ]);
         
        $data['phoneNum'] = $req->phoneNum;
        $data['email'] = $req->email;
        $data['description'] = $req->description;
        $data['address'] = $req->address;

        if($req->hasFile('profile_picture')){
            $file = $req->file('profile_picture');
            $fileName = $user->email.'_'.$file->getClientOriginalName();
            $req->file('profile_picture')->storeAs('image_user', $fileName, 'public');

            $data['icon_url'] = $fileName;
        }

        $user->update($data);
        return redirect(route('profile_company', auth()->id()))->with('success', 'Update Success');
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

    public function verified(Company $company)
    {
        $data['verified'] = 1;
        $company->update($data);

        return redirect()->back();
    }

    public function accepted(Applied_Job $apply)
    {
        $data['status'] = 'Accepted';
        $apply->update($data);

        return redirect()->back();
    }

    public function declined(Applied_Job $apply)
    {
        $data['status'] = 'Declined';
        $apply->update($data);

        return redirect()->back();
    }
}
