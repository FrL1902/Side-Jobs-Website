<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;


    public static function seeRating($id)
    {
        $rating = Rating::where('job_id', $id)->first();

        return $rating->job_rating;
    }

    public static function seeComment($id)
    {
        $rating = Rating::where('job_id', $id)->first();

        return $rating->job_comment;
    }
}
