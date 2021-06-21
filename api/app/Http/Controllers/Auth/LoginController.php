<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        $credentials = array(
            'email' => $request->email,
            'password' => $request->password
        );

        // Custom Message if user login fail
        if(!auth()->attempt($credentials)){
           return response()->json(['data' => 'Login Fail'],401);
        }
    }


    public function logout(Request $request){
        //Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
