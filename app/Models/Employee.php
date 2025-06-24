<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Employee extends Model
{
    use HasFactory;

    public static function fetch_info_whereId($id)
    {
        return DB::selectone(
            "
                SELECT e.id as employee_id,e.name as employee_name,d.name as department_name, b.name as base_name , b.id as base_id
                FROM employees e 
                    INNER JOIN departments d ON d.id=e.department_id
                    INNER JOIN base_emps bs ON bs.employee_id=e.id
                    INNER JOIN base b ON b.id=bs.base_id
                WHERE e.id = ?
            "
        , [$id]);
    }

    public static function cnt_data_whereId($id){
        return DB::selectone(
            "
                SELECT COUNT(id) as cnt
                FROM employees e
                WHERE e.id = ?
            "
        , [$id]);
    }

    public static function fetch_name_whereId($id){
        return DB::selectone(
            "
                SELECT e.name as name
                FROM employees e
                WHERE e.id = ?
            "
        , [$id]);
    }
}
