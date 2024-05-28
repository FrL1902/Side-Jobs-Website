<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search_user_page()
    {
        return view('findUsers');
    }

    public function login_page()
    {
        return view('login');
    }
}
