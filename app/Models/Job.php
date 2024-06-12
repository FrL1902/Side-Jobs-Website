<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
