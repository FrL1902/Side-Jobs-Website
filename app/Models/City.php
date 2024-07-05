<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $primaryKey = 'city_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function seeCity($id){
        $city = City::where('id', '=',(int) $id)->first();
        // dd($city);
        $cityName = $city->city_name;

        return $cityName;
    }

    public static function getCities(){
        $city = City::all();

        return $city;
    }
}
