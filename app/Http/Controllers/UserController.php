<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Applied_Job;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            return redirect()->intended(route('user_homepage'));
        }
        return view('User.login', [
            'title' => 'Login'
        ]);
    }

    public function login_post(Request $req)
    {
        //Check pass and email (fill or blank)
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        // $credentials = $req->only('email', 'password');
        // if(Auth::guard('web')->attempt($credentials)){
        //     dd(Auth::check());
        //     return redirect()->intended(route('user_homepage'));
        $credentials = $req->only('email', 'password');
            if(Auth::guard('web')->attempt($credentials)){
                return redirect()->intended(route('user_homepage'));
            }
        return redirect(route('login'))->with("error", "Login invalid");
    }

    public function register(){

        if(Auth::check()){
            return redirect()->intended(route('user_homepage'));
        }
        return view('User.register', [
            'title' => 'Register'
        ]);
    }

    function register_post(Request $req)
    {
        $req-> validate([
            'fullName' => 'required',
            'phoneNum' => 'required|min:10',
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

        if (User::where('email', '=', $req->email)->exists()) {
            return back()->withInput($req->all())->withErrors(['email' => 'haha']);
        }

        $data['name'] = $req->fullName;
        $data['phoneNum'] = $req->phoneNum;
        $data['email'] = $req->email;
        $data['password'] = Hash::make($req->password);
        $user = User::create($data);

        if(!$user)
        {
            return redirect()->back()->with("error", "Registration Failed, try again");
        }

        return redirect(route('login'))->with("success", "Registration Successfull");
    }

    function profile(User $user){
        return view('User.profile',[
            'title' => 'Profile',
            'user' => $user,
        ]);
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    //View And Edit Profile
    public function edit(User $user)
    {
        return view('User.edit',[
            'title' => 'edit',
            'user' => $user,
        ]);
    }

    public function update(User $user,Request $req)
    {
        
        $req->validate([
            'phoneNum' => 'required|min:10',
            'email' => 'required|email',
            'socMed' => 'required',
            'age' => 'required',
            'edu' => 'required',
            'address' => 'required',
            'updated_at' => now()
        ]);
         
        $data['phoneNum'] = $req->phoneNum;
        $data['email'] = $req->email;
        $data['socialMedia'] = $req->socMed;
        $data['age'] = $req->age;
        $data['education'] = $req->edu;
        $data['address'] = $req->address;

        if($req->hasFile('cv')) {
            $file = $req->file('cv');
            $fileName = $user->email.'_'.$file->getClientOriginalName();
            $req->file('cv')->storeAs('cv_user', $fileName, 'public');

            $data['cv_url'] = $fileName;
        }

        if($req->hasFile('profile_picture')){
            $file = $req->file('profile_picture');
            $fileName = $user->email.'_'.$file->getClientOriginalName();
            $req->file('profile_picture')->storeAs('image_user', $fileName, 'public');

            $data['image'] = $fileName;
        }

        $user->update($data);
        return redirect(route('profile', auth()->id()))->with('success', 'Update Success');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect(route('login'))->with('success', 'Delete Success'); 
    }

    public function home(Applied_Job $apply)
    {
        $accepted = Applied_Job::where('user_id', auth()->user()->id)
        ->where('status', 'Accepted')->get();
        //dd($accepted);

        $apply = Applied_Job::all();
        //dd($apply);
        return view('User.home', [
            'title' => 'Home',
            'applicant' => $apply,
            'accept' => $accepted
        ]);
    }

    public function apply(Job $job)
    {
        $data['user_id'] = auth()->user()->id;
        $data['job_id'] = $job->id;
        $data['status'] = "Waiting";

        Applied_Job::create($data);
        return redirect(route('user_homepage'))->with('success', 'Job Apllied, Waiting For Company Respons');
    }

}
