<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\City;
use App\Models\Employer;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function search_user_page()
    {
        return view('findUsers', [
            'users' => DB::table('users')->simplePaginate(2)
        ]);
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

    public function user_profile(){
        $workerInfo = Worker::where('user_email',  auth()->user()->email)->first();
        $employerInfo = Employer::where('user_email',  auth()->user()->email)->first();

        if(auth()->user()->city_id == '-'){
            $cities = City::all();
            $userInfo = User::where('id',  auth()->user()->id)->first();
            // dd(1);
        } else {
            $cities = City::where('id', '!=', auth()->user()->city_id)->get();
            $userInfo = DB::table('users')
            ->join('cities', 'users.city_id', '=', 'cities.id')
            ->select('users.*', 'cities.city_name')
            ->where('users.id',  auth()->user()->id)->first();
            // dd(2);
        }

        $jobCount = DB::table('jobs')
            ->where('employer_id', auth()->user()->id)->count();

        if($jobCount == 0){
            $jobCount = '0';
        }
        // dd($cities);
        // dd($userInfo);

        if(auth()->user()->bank_id == '-'){
            $banks = Bank::all();
        } else {
            $banks = Bank::where('id', '!=', auth()->user()->bank_id)->get();
        }

        return view('profile', compact('userInfo', 'workerInfo', 'employerInfo', 'cities', 'jobCount', 'banks'));
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
        $account->image_path = '-';
        $account->bank_id = '-';
        $account->account_number = '-';
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

        session()->flash('status', 'Applicant Diterima!');

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

    public function change_profile_picture(Request $request){
        // dd(1);
        // old method of inserting image without "Image Intervention"

        $request->validate([ // cek image terakhir karena berat
            'user_image' => 'required|mimes:jpeg,png,jpg|max:10240',
        ], [
            'user_image.required' => 'Gambar harus dimasukkan',
            'user_image.mimes' => 'Tipe file yang diterima hanya jpeg, jpg, dan png',
            'user_image.max' => 'Ukuran foto harus dibawah 10 MB'
        ]);

        if(auth()->user()->image_path != '-'){
            Storage::delete('public/' . auth()->user()->image_path);
        }

        $file = $request->file('user_image');
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs('public/userImage', $file, $imageName);
        $imageName = 'userImage/' . $imageName;

        User::where('id',  auth()->user()->id)->update([
            'image_path' => $imageName,
        ]);

        session()->flash('statusSuccess', 'Profile Picture Changed!');
        return redirect()->back();
    }

    public function change_user_info(Request $request){
        // dd(2);
        $request->validate([
            'phone_number' => 'required|max:30',
            'city' => 'required',
            'bank' => 'required',
            'user_bank_account' => 'required|min:3|max:50',
            'user_address' => 'required|min:10|max:100',
        ], [
            'phone_number.required' => 'Phone Number anda harus diisi',
            'phone_number.max' => 'Phone Number maksimal 30 karakter',
            'city.required' => 'city anda harus diisi',
            'bank.required' => 'bank anda harus diisi',
            'user_bank_account.required' => 'rekening bank anda harus diisi',
            'user_bank_account.min' => 'rekening bank minimal 3 karakter',
            'user_bank_account.max' => 'rekening bank maksimal 50 karakter',
            'user_address.required' => 'address anda harus diisi',
            'user_address.min' => 'address minimal 10 karakter',
            'user_address.max' => 'address maksimal 100 karakter',
        ]);
        // dd(2);

        User::where('id',  auth()->user()->id)->update([
            'phone_number' => $request->phone_number,
            'city_id' => $request->city,
            'bank_id' => $request->bank,
            'account_number' => $request->user_bank_account,
            'address' => $request->user_address,
        ]);

        session()->flash('statusSuccess', 'User Info Changed!');
        return redirect()->back();
    }

    public function change_worker_info(Request $request){
        // dd($request->worker_description . $request->worker_preference);
        // dd(1);
        $request->validate([
            'worker_description' => 'required|min:30|max:200',
            'worker_preference' => 'required|min:10|max:100',
        ], [
            'worker_description.required' => 'description anda harus diisi',
            'worker_description.min' => 'description minimal 30 karakter',
            'worker_description.max' => 'description maksimal 200 karakter',
            'worker_preference.required' => 'preference pekerjaan harus diisi',
            'worker_preference.min' => 'preference minimal 10 karakter',
            'worker_preference.max' => 'preference maksimal 100 karakter',
        ]);
        // dd(2);

        Worker::where('user_email',  auth()->user()->email)->update([
            'worker_description' => $request->worker_description,
            'worker_preference' => $request->worker_preference,
        ]);

        session()->flash('statusSuccess', 'Worker Info Changed!');
        return redirect()->back();
    }

    public function change_employer_info(Request $request){
        // dd($request->employer_description . $request->employer_address);

        $request->validate([
            'employer_description' => 'required|min:30|max:200',
            'employer_address' => 'required|min:10|max:100',
        ], [
            'employer_description.required' => 'description anda harus diisi',
            'employer_description.min' => 'description minimal 30 karakter',
            'employer_description.max' => 'description maksimal 200 karakter',
            'employer_address.required' => 'address kerja anda harus diisi',
            'employer_address.min' => 'address minimal 10 karakter',
            'employer_address.max' => 'address maksimal 100 karakter',
        ]);

        Employer::where('user_email',  auth()->user()->email)->update([
            'employer_description' => $request->employer_description,
            'employer_address' => $request->employer_address,
        ]);

        session()->flash('statusSuccess', 'Employer Info Changed!');
        return redirect()->back();
    }

    public function view_user_profile($id){
        $userData = User::find($id);
        $workerInfo = Worker::where('user_email',  $userData->email)->first();
        $employerInfo = Employer::where('user_email',  $userData->email)->first();
        // $userInfo = DB::table('users')
        //     ->join('cities', 'users.city_id', '=', 'cities.id')
        //     ->select('users.*', 'cities.city_name')
        //     ->where('users.id',  $userData->id)->first();

        $jobCount = DB::table('jobs')
            ->where('employer_id', $userData->id)->count();

        if($jobCount == 0){
            $jobCount = '0';
        }

        // dd($userInfo);
        return view('userProfiles', compact('userData', 'workerInfo', 'employerInfo', 'jobCount')); //ganti dari userinfo ke userdata, gajelas kenapa ga bisa anjing
    }
}
