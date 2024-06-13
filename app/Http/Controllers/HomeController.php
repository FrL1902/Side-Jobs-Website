<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $availableJobs = Job::where(function($query) {
            $query->where('job_status', 'opened');
        })
        ->latest()->take(2)->get();

        if(Auth::check() && auth()->user()->role != 3){
            if(auth()->user()->role == 1){ //worker
                $activeJobs = Job::where('worker_id', auth()->user()->id)
                    ->where(function($query) {
                        $query->where('job_status', 'opened')
                            ->orWhere('job_status', 'ongoing');
                    })
                    ->latest()->take(2)->get();

            } else if(auth()->user()->role == 2){ //employer
                $activeJobs = Job::where('employer_id', auth()->user()->id)
                    ->where(function($query) {
                        $query->where('job_status', 'opened')
                            ->orWhere('job_status', 'ongoing');
                    })
                    ->latest()->take(2)->get();
            }

            return view('home', compact('activeJobs','availableJobs'));
        } else {
            return view('home', compact('availableJobs'));
        }
    }

    public function welcome(Request $request)
    {
        return view('homeLoggedIn');
    }
}
