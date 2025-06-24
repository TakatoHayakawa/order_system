<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Factory extends Model
{
    use HasFactory;

    public static function fect_all(){
        return DB::select(
            "
                SELECT id,name FROM factory;
            "
        );
    }

    public static function fetch_name_where_id($id){
        return DB::selectone(
            "
                SELECT name FROM factory WHERE id=?;
            "
        , [$id]);
    }
}
