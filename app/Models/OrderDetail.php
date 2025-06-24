<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class OrderDetail extends Model
{
    use HasFactory;

    public static function insert($order_id, $furniture_id, $num_for_each_order, $order_num, $amout){
        return DB::insert(
            "
                INSERT INTO order_details  (order_id,furniture_id,num_for_each_order,order_num,amout,shipped_num) VALUES (?,?,?,?,?,'0');
            "
        , [$order_id, $furniture_id, $num_for_each_order, $order_num, $amout]);
    }

    public static function fetch_info_where_order_id($order_id){
        return DB::select(
            "
                SELECT f.name as furniture_name, order_num, shipped_num, amout 
                FROM order_details od 
                    LEFT OUTER JOIN furnitures f ON od.furniture_id=f.id
                WHERE od.order_id=?
                    
            "
        , [$order_id]);
    }
}
