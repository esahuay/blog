<?php

namespace App\Http\Controllers\Auth;

use App\student;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;

class StudentAuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = "student";
        $this->middleware('student.guest', ['except' => 'getLogout']);
    }

    protected $loginPath='/student/auth/login';
    protected $redirectAfterLogout = "/student/auth/login";
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
        if(\Auth::user('student')){
            return redirect()->route('student.home');
        }
        return view('student.auth.login');
    }
}