<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware('is.admin',['except' => ['showLoginForm', 'login','logout']]);
    }
    public function dashboard()
    {

        //dd($notifications);
        return view('admin.dashboard.dashboard');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
       $request->validate([
        'email'    => 'required|email|exists:admins|min:5|max:191',
        'password' => 'required|string|min:4|max:255',
       ]);
       if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
        //Authentication passed...
            return redirect()
                ->intended(route('admin.dashboard'))
                ->with('status','You are Logged in as Admin!');
        }
        return redirect()
        ->back()
        ->withInput()
        ->withErrors('Login failed, please try again!');


    }

    public function logout()
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.showLoginForm')->with('message','Admin has been logged out!');;
        }



}
