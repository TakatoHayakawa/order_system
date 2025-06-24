<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\Employee;
use App\Models\Account;
use App\Models\User;
use App\Models\ErrorMsg;

class MyAuthController extends Controller
{
    public function login(Request $request)
    {
        $ER_MSG = new ErrorMsg();

        $ERMSG_ID_IDPW = $ER_MSG->set_ErrorMsg("IDまたはPWを入力してください。");
        
        $credentials = $request->validate([
            'email'    => ['required'],
            'password' => ['required']
        ]);

        $ER_MSG->delete_ErrorMsg($ERMSG_ID_IDPW);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('OA/top');
        }

        $ER_MSG->set_ErrorMsg("Loginに失敗しました。 IDまたはPWが違います。");
        return redirect('/Login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('Login');
    }

    public function signup(Request $request){
        $employee_id = $request->email;

        $ER_MSG = new ErrorMsg();
        $ERMSG_ID_IDPW = $ER_MSG->set_ErrorMsg("設定するIDまたはPWを入力してください。");


        //バリデーション
        $credentials = $request->validate([
            'email'    => ['required'],
            'password' => ['required']
        ]);

        $ER_MSG->delete_ErrorMsg($ERMSG_ID_IDPW);
        
        //存在する従業員のIDでなければダメ
        if(Employee::cnt_data_whereId($request->email)->cnt == 0){
            $ER_MSG->set_ErrorMsg("存在しない従業員のIDは登録できません。");
            return redirect('Signup');
        }
        
        //すでに登録されたアカウントならダメ
        if(Account::cnt_data_whereEmployee_id($request->email)->cnt == 1){
            $ER_MSG->set_ErrorMsg("既に使われているIDは登録できません。");
            return redirect('Signup');
        }

        $name = Employee::fetch_name_whereId($request->email)->name;

        //登録処理
        User::self_insert([
                'name'     => $name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

        Account::insert(
            [
                'email'    => $request->email,
                'password' => $request->password,
            ]
            );

        return redirect('/');
    }
}
