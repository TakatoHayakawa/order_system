<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Account extends Model  
{
    use HasFactory;

    public static function cnt_data_whereEmployee_id($id){
        return DB::selectone(
            "
                SELECT COUNT(id) as cnt
                FROM accounts as a
                WHERE a.employee_id = ?
            "
        , [$id]);
    }

    public static function insert($infos){
        return DB::insert(
            " INSERT INTO accounts (employee_id,password) VALUES (?,?) "
        , [$infos["email"], $infos["password"]]);
    }
}
