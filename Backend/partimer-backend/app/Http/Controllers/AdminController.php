<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(){

        if(!auth()->user()->isAdmin){
            return redirect()->intended(route('landingPage'));
        }
        return view('', [
            'title' => 'Admin'
        ]);
    }


}
