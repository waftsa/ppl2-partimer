<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        if(!Auth::guard('admins')){
            return redirect()->intended(route('landing_page'));
        }

        return view('Admin.login', [
            'title' => 'Admin'
        ]);
    }

    public function login_post(Request $req)
    {
        //Check pass and email (fill or blank)
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        $credentials = $req->only('email', 'password');
        if(Auth::guard('admins')->attempt($credentials)){
            return redirect()->intended(route('admin_home'));
        }
        return redirect(route('login'))->with("error", "Login invalid");
    }
    

}
