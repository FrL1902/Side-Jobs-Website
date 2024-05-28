<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function search_job_page(Request $request)
    {
        return view('findJobs');
    }//
}
