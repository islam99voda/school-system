<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Traits\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{


    use AuthTrait;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function loginForm($type='admin') //admin is default
    {
        return view('auth.login', compact('type'));
    }

    public function login(Request $request)
    {
        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        }
        return back()->withErrors([
            'email' => '. The email or password is incorrect'
        ]);
    }

    public function logout(Request $request, $type)
    {
        $locale = Session::get('locale');
    
        Auth::guard($type)->logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        Session::put('locale', $locale);
    
        return redirect('/');
    }
    

}
