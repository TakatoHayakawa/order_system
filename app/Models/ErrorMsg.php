<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorMsg extends Model
{
    use HasFactory;

    public  $MSG = [];
    public  $id  = 0;



    public  function set_ErrorMsg($msg){
        /*
        ## 表示したいメッセージを第一引数に設定する。
        戻り値：設定したメッセージIDが変える。
        　　　　このIDは、メッセージを削除したいときに使う。
        　　　　例）　error_msg->delete_ErrorMsg($id);
        */
        array_push($this->MSG, [
            "text" => $msg,
            "id"   => $this->id
        ]);
        $this->id += 1;
        session()->put('error_msgs',  $this->MSG);
        return $this->id - 1;
    }

    public  function delete_ErrorMsg($id){
        $index = 0;
        foreach($this->MSG as $msg){
            if($msg['id'] == $id){
                unset($this->MSG[$index]);
            }
        }

        session()->put('error_msgs',  $this->MSG);
    }
}
