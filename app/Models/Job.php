<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Job extends Model
{
    use HasFactory;

    public static function applyCheck($jobId, $userId){
        // dd($jobId . $userId);
        // $city = City::where('id', '=',(int) $id)->first();
        // // dd($city);
        // $cityName = $city->city_name;
        $data = Appliers::where('worker_id', $userId)->where('job_id', $jobId)->count();
        // ada 1 = udah pernah apply
        // 0 = ga pernah apply

        return $data;
    }

    public static function checkOngoingJob(){
        $data = Job::where('job_status', 'ongoing')->where('worker_id', auth()->user()->id)->count();
        // dd($data);

        if($data>0){
            return true;
        }

        return false;
    }

    public static function seeFinishedJobs($email){
        $user = User::where('email', $email)->first();

        $job = Job::where('worker_id', $user->id)->where('job_status', 'finished')->count();

        return $job;
    }

    public static function seeRating($email){
        $user = User::where('email', $email)->first();
        $job = Job::where('worker_id', $user->id)->where('job_status', 'finished')->count();

        $score = DB::table('ratings')
            ->join('jobs', 'jobs.id', '=', 'ratings.job_id')
            ->select('ratings.job_rating')->where('jobs.worker_id', $user->id)->sum('ratings.job_rating');
            // InPallet::where('item_id', $request->itemidforpallet)->sum('stock');

        $rating = $score/$job;
        return $rating;
    }
}
