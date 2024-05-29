<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function user_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'email harus diisi',
            'password.required' => 'password harus diisi'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // dd(Auth::user());
            // $userInfo = DB::table('users')->select('*')->where('email', $request->email)->first();
            // dd($userInfo);
            return redirect()->intended('/');
            // return view('home');
        } else {
            session()->flash('status', 'informasi yang dimasukkan salah');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();

        // session()->invalidate();

        // session()->regenerateToken();

        return redirect('/');
    }

    public function switch_role_to_worker()
    {
        // dd(auth()->user());
        User::where('id',  auth()->user()->id)->update([
            'role' =>1,
        ]);

        return redirect('/');
    }

    public function switch_role_to_employer()
    {
        User::where('id',  auth()->user()->id)->update([
            'role' =>2,
        ]);

        return redirect('/');
    }
}
