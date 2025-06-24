<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class TopController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // // 認証済みユーザーを取得
            $user = \Auth::user();

            
            $login_employee = Employee::fetch_info_whereId($user->email);

            $data = [
                'id' => $user->email
            ];
            session()->put('employee' ,   $login_employee);
            session()->put('account_id' , $user->email);    


            
            return view('OA/top', $data);
        }
        
        
        return redirect("Login");
    }
}
