<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function search_job_page()
    {
        return view('findJobs');
    }//

    public function manage_jobs_page()
    {
        return view('manageJobs');
    }
}
