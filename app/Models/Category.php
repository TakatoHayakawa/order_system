<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    use HasFactory;

    public static function fect_all()
    {
        return DB::select(
            "
                SELECT id,name FROM categorys;
            "
        );
    }
}
