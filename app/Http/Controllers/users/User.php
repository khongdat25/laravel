<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User extends Controller
{
    public function login() {
        return view('auth.login');
    }
    public function register() {
        return view('auth.register');
    }
}
    