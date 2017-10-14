<?php

namespace App\Http\Controllers\Auth;

use App\Profesor;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;

class ProfesorAuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = "profesor";
        $this->middleware('profesor.guest', ['except' => 'getLogout']);
    }

    protected $loginPath='/profesor/auth/login';
    protected $redirectAfterLogout = "/profesor/auth/login";
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected  function getLogin()
    {
        if(\Auth::user('profesor')){
            return redirect()->route('profesor.home');
        }
        return view('profesor.auth.login');
    }
}