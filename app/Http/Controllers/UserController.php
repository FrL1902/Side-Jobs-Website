<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function register_page()
    {
        return view('register');
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

    public function make_account(Request $request)
    {
        // dd($request);
        $request->validate([
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'email' => 'required|unique:App\Models\User,email',
            'password' => 'required'
        ], [
            'firstName.required' => 'nama depan harus diisi',
            'firstName.min' => 'nama depan minimal 2 karakter',
            'firstName.max' => 'nama depan maksimal 50 karakter',
            'lastName.required' => 'nama belakang harus diisi',
            'lastName.min' => 'nama belakang minimal 2 karakter',
            'lastName.max' => 'nama belakang minimal 50 karakter',
            'email.required' => 'email harus diisi',
            'email.unique' => 'email telah terambil, masukkan email lain',
            'password.required' => 'password harus diisi',
        ]);

        $account = new User();
        $account->email = $request->email;
        $account->password = Hash::make($request->password);
        $account->role = 1; #default, langsung jadi worker dulu minimal, nanti daftar jadi workernya ntar aja
        $account->first_name = $request->firstName;
        $account->last_name = $request->lastName;
        $account->phone_number = '-';
        $account->city_id = '-';
        $account->address = '-';
        $account->account_activated = 'yes';
        $account->image_path = 'https://cdn.discordapp.com/attachments/1211571942965125160/1245333634555314256/image.png?ex=66585ed3&is=66570d53&hm=c7dc8bd96a82f1acf657238514336414d8551bf3347fde69e6c3a94de8854cc6&';
        $account->save();

        $worker = new Worker();
        $worker->user_email = $request->email;
        $worker->worker_description = '-';
        $worker->worker_preference = '-';
        $worker->save();

        $employer = new Employer();
        $employer->is_unlocked = 'no';
        $employer->user_email = $request->email;
        $employer->employer_address = '-';
        $employer->employer_description = '-';
        $employer->save();


        return redirect('/');
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
