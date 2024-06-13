<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public static function seeBank($id)
    {
        $bank = Bank::find($id);

        return $bank->bank_name;
    }
}
