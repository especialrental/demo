<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Radis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Authenticatable;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->passes()){

            //Now Authanticate admin

            if(Auth::guard('admin')->attempt(['email'=> $request->email , 'password' =>$request->password])){

            $user =Auth::guard('admin')->user();
             $request->session()->put('email',$request->email);
            if($user->role == 'admin'){
                
                return redirect()->route('admin.dashboard');
            }
            else{

                //Logout current session and back to login page
                Auth::guard('admin')->logout();
                $request->session()->flash('error','Either email/password is incorrect');
                return redirect()->route('auth.login');
            }
            
        }else{
                $request->session()->flash('error','Either email/password is incorrect');
                return redirect()->route('auth.login');
          }
        }
        
        else{
            //Redirect login page with error
            return back()->withInput($request->only('email'))->withErrors($validator);
        }
    }

    public function logout(Request $request)
    {

    if(session()->has('email'))
    {
        session()->pull('email',null);
    }

    return view("auth.login");
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
}
