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

    public function employer_register_page(){
        return view('employerRegister');
    }

    public function employer_applicants_page(){
        $employer = Employer::all();

        return view('applicants', compact('employer'));
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
        $employer->has_applied = 'no';
        $employer->user_email = $request->email;
        $employer->employer_address = '-';
        $employer->employer_description = '-';
        $employer->save();


        return redirect('/');
    }

    public function employer_register(Request $request){

        $userApplied = Employer::where('user_email',  auth()->user()->email)->first();
        if($userApplied->has_applied == 'yes'){
            session()->flash('status', 'anda sudah mendaftar, mohon menunggu');
            return redirect()->back();
        }

        $request->validate([
            'background' => 'required|min:30|max:200',
            'location' => 'required|min:10|max:100',
        ], [
            'background.required' => 'latar belakang (background) anda harus diisi, ceritakan sedikit tentang anda',
            'background.min' => 'latar belakang (background) minimal 30 karakter',
            'background.max' => 'latar belakang (background) maksimal 200 karakter',
            'location.required' => 'lokasi kerja anda harus diisi, lokasi pekerjaan yang anda akan buka, offline (tempatnya apa) atau online dengan apa',
            'location.min' => 'lokasi kerja minimal 10 karakter',
            'location.max' => 'lokasi kerja maksimal 100 karakter',
        ]);

        // Employer::where('id',  auth()->user()->id)->update([
        //     'role' =>1,
        // ]);

        // dd($request->background);

        Employer::where('user_email',  auth()->user()->email)->update([
            'employer_description' => $request->background,
            'employer_address' => $request->location,
            'has_applied' => 'yes',
        ]);


        return redirect('/');
    }

    public function accept_employer_applicant($id){
        // dd($id . 1);
        Employer::where('user_email',  $id)->update([
            'is_unlocked' => 'yes',
        ]);

        return redirect()->back();
    }

    public function decline_employer_applicant($id){
        // dd($id . 2);
        Employer::where('user_email',  $id)->update([
            'is_unlocked' => 'no',
            'has_applied' => 'no',
            'employer_address' => '-',
            'employer_description' => '-',
        ]);

        return redirect()->back();
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
