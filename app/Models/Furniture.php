<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Furniture extends Model
{
    use HasFactory;

    public static function fetch_info(){
        return DB::select(
            "
                SELECT id,name,price
                FROM furnitures
            "
        );
    }

    public static function fetch_info_where_id($sql_where_category_id){
        return DB::select(
            "
                SELECT f.id as id,f.name as name, f.price as price
                FROM furnitures f 
                    INNER JOIN category_compatibles cc ON cc.furniture_id=f.id
                    INNER JOIN categorys c ON cc.category_id=c.id
                WHERE 1=1 
                AND c.id=?
            "
        , [$sql_where_category_id]);
    }

    public static function fetch_info_where_nameLike($sql_where_search){
        return DB::select(
            "
                SELECT id,name,price
                FROM furnitures
                WHERE 1=1 
                AND name LIKE ?
            "
        , [$sql_where_search]);
    }

    public static function fetch_info_where_id_nameLike($sql_where_category_id, $sql_where_search){
        return DB::select(
            "
                SELECT f.id as id,f.name as name, f.price as price
                FROM furnitures f 
                    INNER JOIN category_compatibles cc ON cc.furniture_id=f.id
                    INNER JOIN categorys c ON cc.category_id=c.id
                WHERE 1=1 
                AND c.id=? 
                AND f.name LIKE ?
            "
        , [$sql_where_category_id, $sql_where_search]);
    }
}
