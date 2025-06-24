<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class Order extends Model
{
    use HasFactory;

        public static function insert($base_id, $factry_id, $account_id, $order_at){
            return DB::insert(
                "
                    INSERT INTO orders (base_id,factory_id,account_id,order_at) VALUES (?,?,?,?);
                "
            , [$base_id, $factry_id, $account_id, $order_at]);
        }

        public static function fetch_max_id(){
            return DB::selectone(
                "
                    SELECT MAX(id) as id FROM orders; 
                "
            );
        }

        public static function fetch_info(){
            return DB::select(
                "
                    SELECT o.id as order_id, f.name as factory_name, b.name as base_name,  e.name as employee_name, o.order_at
                        FROM orders o 
                        LEFT OUTER JOIN factory f ON o.factory_id=f.id 
                        LEFT OUTER JOIN base b ON o.base_id=b.id
                        LEFT OUTER JOIN accounts ac ON o.account_id=ac.id
                        LEFT OUTER JOIN employees e ON ac.employee_id=e.id
                "
            );
        }

        public static function fetch_info_where_id($id){
            return DB::selectone(
                "
                    SELECT o.id as order_id, f.name as factory_name, b.name as base_name,  e.name as employee_name, o.order_at
                    FROM orders o 
                        LEFT OUTER JOIN factory f ON o.factory_id=f.id 
                        LEFT OUTER JOIN base b ON o.base_id=b.id
                        LEFT OUTER JOIN accounts ac ON o.account_id=ac.id
                        LEFT OUTER JOIN employees e ON ac.employee_id=e.id
                    WHERE o.id=?
                "
            , [$id]);
        }
}
