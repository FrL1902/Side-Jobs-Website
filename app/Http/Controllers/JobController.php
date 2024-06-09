<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function search_job_page()
    {
        $activeJobs = Job::where(function($query) {
                        $query->where('job_status', 'opened');
                    })
                    ->simplePaginate(5);

        return view('findJobs', compact('activeJobs'));
    }

    public function manage_jobs_page()
    {
        $city = City::all();

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

        session()->flash('status', 'New Job Made!');
        return redirect()->back();
    }

    public function view_job($id){
        $jobInfo = Job::find($id);

        return view('viewJob', compact('jobInfo'));
    }
}
