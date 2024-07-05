<?php

namespace App\Http\Controllers;

use App\Models\Appliers;
use App\Models\Bank;
use App\Models\City;
use App\Models\Job;
use App\Models\Rating;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function search_job_page(Request $request)
    {
        session()->forget('filter');
        // $activeJobs = Job::where(function($query) {
        //                 $query->where('job_status', 'opened');
        //             })
        //             ->simplePaginate(5);

        $activeJobs = Job::query();

        $activeJobs->when($request->is_online, function ($query) use ($request) {
            session()->flash('filter', 'filter');
            return $query->where('job_status', 'opened')
                        ->where('is_online', '=', 'yes');
        });

        $activeJobs->when($request->job_name, function ($query) use ($request) {
            session()->flash('filter', 'filter');
            return $query->where('job_title', 'like', '%'.$request->job_name.'%');
        });

        $activeJobs->when($request->job_area, function ($query) use ($request) {
            session()->flash('filter', 'filter');
            return $query->where('city', 'like', $request->job_area);
        });

        $activeJobs->when($request->compensation_min, function ($query) use ($request) {
            session()->flash('filter', 'filter');
            return $query->where('job_compensation', '>=', $request->compensation_min);
        });

        $activeJobs->when($request->compensation_max, function ($query) use ($request) {
            session()->flash('filter', 'filter');
            return $query->where('job_compensation', '<=', $request->compensation_max);
        });

        $activeJobs->when($request->deadline, function ($query) use ($request) {
            session()->flash('filter', 'filter');
            $date_to = Carbon::parse($request->deadline)->endOfDay();
            // dd($date_to);
            return $query->whereDate('job_deadline', '<=', $date_to);
        });

        // return view('findJobs', compact('activeJobs'));
        return view('findJobs', ['activeJobs' => $activeJobs->where('job_status', 'opened')->latest()->simplePaginate(5)]);
    }

    public function manage_jobs_page()
    {
        $city = City::all();

        if(auth()->user()->role == 1){
            $activeJobs = Job::where('worker_id', auth()->user()->id)
                ->where(function($query) {
                    $query->where('job_status', 'opened')
                        ->orWhere('job_status', 'ongoing');
                })
                ->latest()->take(2)->get();

            $pastJobs = Job::where('worker_id', auth()->user()->id)
                ->where(function($query) {
                    $query->where('job_status', 'finished')
                        ->orWhere('job_status', 'cancelled');
                })
                ->latest()->take(2)->get();

        } else if(auth()->user()->role == 2){
            $activeJobs = Job::where('employer_id', auth()->user()->id)
                ->where(function($query) {
                    $query->where('job_status', 'opened')
                        ->orWhere('job_status', 'ongoing');
                })
                ->latest()->take(2)->get();

            $pastJobs = Job::where('employer_id', auth()->user()->id)
                ->where(function($query) {
                    $query->where('job_status', 'finished')
                        ->orWhere('job_status', 'cancelled');
                })
                ->latest()->take(2)->get();
        }
        // dd($job);


        // $activeJobs = DB::table('jobs')
        // ->join('cities', 'jobs.city', '=', 'cities.id')
        // ->select('jobs.*', 'cities.city_name')
        // ->where('jobs.employer_id', auth()->user()->id)
        // ->where(function($query) {
        //     $query->where('jobs.job_status', 'opened')
        //         ->orWhere('jobs.job_status', 'ongoing');
        // })
        // ->latest()->take(2)->get();

        // $pastJobs = DB::table('jobs')
        // ->join('cities', 'jobs.city', '=', 'cities.id')
        // ->select('jobs.*', 'cities.city_name')
        // ->where('jobs.employer_id', auth()->user()->id)
        // ->where(function($query) {
        //     $query->where('jobs.job_status', 'finished')
        //         ->orWhere('jobs.job_status', 'cancelled');
        // })
        // ->latest()->take(2)->get();

        return view('manageJobs', compact('city', 'activeJobs', 'pastJobs'));
    }

    public function make_job(Request $request){
        // dd($request);

        $request->validate([
            'employer_address' => 'required|min:2|max:50', //ganti
            'job_description' => 'required|min:2|max:100',
            'compensation' => 'required',
            // 'job_type' => 'required' gaada
            'deadline' => 'required',
        ], [
            'employer_address.required' => 'job title harus diisi',
            'employer_address.min' => 'title minimal 2 karakter',
            'employer_address.max' => 'title maksimal 50 karakter',
            'job_description.required' => 'description harus diisi',
            'job_description.min' => 'description minimal 2 karakter',
            'job_description.max' => 'description maksimal 50 karakter',
            'compensation.required' => 'compensation depan harus diisi',
            'deadline.required' => 'deadline harus diisi',
        ]);

        if($request->job_type){ //ni buat ngecek kalo job typenya offline aja
            // online
        } else {
            // offline
            $request->validate([
                'city' => 'required',
                'address' => 'required|min:2|max:50',
            ], [
                'city.required' => 'city harus dipilih',
                'address.required' => 'address harus diisi',
                'address.min' => 'address minimal 2 karakter',
                'address.max' => 'address maksimal 50 karakter',
            ]);
        }

        // if($request->job_type){
        //     // dd(1);
        // } else
        // // dd(2);

        $job = new Job();
        $job->job_title = $request->employer_address;
        $job->job_description = $request->job_description;
        $job->job_compensation = $request->compensation;
        $job->job_deadline = $request->deadline;
        $job->job_status = 'opened'; //opened, ongoing, finished, cancelled
        $job->is_active = 'yes'; // yes atau no
        $job->worker_id = '-';
        $job->employer_id = auth()->user()->id;

        if($request->job_type){
            // online
            $job->address = '-';
            $job->city = '-';
            $job->is_online = 'yes';
        } else {
            // offline
            $job->address = $request->address;
            $job->city = $request->city;
            $job->is_online = 'no';
        }

        $job->save();

        session()->flash('statusSuccess', 'New Job Made!');
        return redirect()->back();
    }

    public function view_job($id){
        $jobInfo = Job::find($id);

        return view('viewJob', compact('jobInfo'));
    }

    public function job_info($id){
        $jobInfo = Job::find($id);
        $appliers = Appliers::where('job_id', $jobInfo->id)->get();
        $banks = Bank::all();
        $city = City::all();

        return view('jobinfo', compact('jobInfo', 'appliers', 'banks', 'city'));
    }

    public function apply_Job(Request $request){
        if(auth()->user()->bank_id == '-'){
            session()->flash('statusFailed', 'Failed, please set up your user profile first');
            return redirect()->back();
        }

        $request->validate([
            'job_message' => 'required|min:2|max:250',
        ], [
            'job_message.required' => 'message harus diisi',
            'job_message.min' => 'message minimal 2 karakter',
            'job_message.max' => 'message maksimal 250 karakter',
        ]);

        $applier = new Appliers();
        $applier->worker_id = $request->applierIdHidden;
        $applier->job_id = $request->jobIdHidden;
        $applier->apply_description = $request->job_message;
        $applier->status = 'applying';
        $applier->save();

        session()->flash('statusSuccess', 'Applied to job!');

        return redirect()->back();
    }

    public function decline_worker(Request $request){
        Appliers::where('worker_id', $request->workerId)->where('job_id', $request->jobId)->update([
            'status' => 'declined',
        ]);

        session()->flash('statusSuccess', 'Worker Rejected!');
        return redirect()->back();
    }

    public function accept_worker(Request $request){
        // dd(2);
        Appliers::where('worker_id', $request->workerId)->where('job_id', $request->jobId)->update([
            'status' => 'accepted',
        ]);

        Appliers::where('job_id', $request->jobId)->where('status', 'applying')->update([
            'status' => 'declined',
        ]);

        Job::where('id', $request->jobId)->update([
            'job_status' => 'ongoing',
            'worker_id' => $request->workerId,
        ]);

        session()->flash('statusSuccess', 'Worker Accepted!');
        return redirect()->back();
    }

    public function cancel_job($id){
        // dd($id);
        Job::where('id', $id)->update([
            'job_status' => 'cancelled',
            'is_active' => 'no',
        ]);

        session()->flash('statusSuccess', 'Job Cancelled!');
        return redirect('/manageJobs');
    }

    public function end_job(Request $request){
        $request->validate([
            'bank_id' => 'required',
            'bank_account_number' => 'required|min:3|max:50',
            'jobCompensation' => 'required',
            'rating' => 'required|min:0|max:5',
            'comment' => 'required|min:2|max:250',
            'jobIdHidden' => 'required',

        ], [
            'bank_id.required' => '',
            'bank_account_number.required' => 'rekening bank anda harus diisi',
            'bank_account_number.min' => 'rekening bank minimal 3 karakter',
            'bank_account_number.max' => 'rekening bank maksimal 50 karakter',
            'jobCompensation.required' => 'compensation null error',
            'rating.required' => 'rating harus diisi',
            'rating.min' => 'rating minimal 0',
            'rating.max' => 'rating maksimal 5',
            'comment.required' => 'comment harus diisi',
            'comment.min' => 'comment minimal 2 karakter',
            'comment.max' => 'comment maksimal 250 karakter',
            'jobIdHidden.required' => 'job id null error',
        ]);

        Job::where('id', $request->jobIdHidden)->update([
            'job_status' => 'finished',
            'is_active' => 'no',
        ]);

        $ratings = new Rating();
        $ratings->job_id = $request->jobIdHidden;
        $ratings->job_rating = $request->rating;
        $ratings->job_comment = $request->comment;
        $ratings->save();

        $transaction = new Transaction();
        $transaction->bank_id = $request->bank_id;
        $transaction->job_id = $request->jobIdHidden;
        $transaction->account_number = $request->bank_account_number;
        $transaction->value = $request->jobCompensation;
        $transaction->save();

        session()->flash('statusSuccess', 'Job Finished!');
        return redirect('/manageJobs');
    }

    public function active_jobs_page(){
        if(auth()->user()->role == 1){
            $activeJobs = Job::where('worker_id', auth()->user()->id)
                ->where(function($query) {
                    $query->where('job_status', 'opened')
                        ->orWhere('job_status', 'ongoing');
                })
                ->latest()->simplePaginate(10);

        } else if(auth()->user()->role == 2){
            $activeJobs = Job::where('employer_id', auth()->user()->id)
                ->where(function($query) {
                    $query->where('job_status', 'opened')
                        ->orWhere('job_status', 'ongoing');
                })
                ->latest()->simplePaginate(10);
        }

        return view('activeJobs', compact('activeJobs'));
    }

    public function past_jobs_page(){
        if(auth()->user()->role == 1){
            $pastJobs = Job::where('worker_id', auth()->user()->id)
                ->where(function($query) {
                    $query->where('job_status', 'finished')
                        ->orWhere('job_status', 'cancelled');
                })
                ->latest()->simplePaginate(10);

        } else if(auth()->user()->role == 2){
            $pastJobs = Job::where('employer_id', auth()->user()->id)
                ->where(function($query) {
                    $query->where('job_status', 'finished')
                        ->orWhere('job_status', 'cancelled');
                })
                ->latest()->simplePaginate(10);
        }

        return view('pastJobs', compact('pastJobs'));
    }

    public function user_applies_job(){
        $appliers = Appliers::where('worker_id', auth()->user()->id)->latest()->get();

        return view('userApply', compact('appliers'));
    }
}
