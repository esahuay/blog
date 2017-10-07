<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Sarav\Multiauth\Foundation\ResetsPasswords;

class StudentPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = "student";
        $this->middleware('student.guest');
    }
}