<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class ProviderLoginController extends Controller
{

    use AuthenticatesUsers;

    public function showLoginForm(){
    	return view('auth.provider-login');
    }
    // public function login()
    // {
    //     $this->validate($request, [
    //         'ak_provider_email' => 'required|email',
    //         'ak_provider_password' => 'required|min:6'
    //         ]);
    //     Auth::attempt($credetials, $remember);

    // }
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:provider', ['except' => 'logout']);
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {
        return 'ak_provider_email';
    }

    protected function guard()
    {
        return Auth::guard('provider');
    }

}
