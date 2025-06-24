<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Factory;
use App\Models\Category;
use App\Models\Furniture;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ErrorMsg;

class OrderController extends Controller
{
    public function index()
    {
        
        //sessionにデータを入れる
        if( session()->has('order_details') == null){
            $order_details = [];
            session()->put('order_details',  $order_details);
        }
        

        //工場のデータを格納
        $factorys = Factory::fect_all();
        $data = [
            'factorys' => $factorys,
        ];

        return view('OA/Order', $data);
    }


    public function check(Request $request){
        
        $ER_MSG = new ErrorMsg();

        $ERMSG_ID_FACTORY_ID = $ER_MSG->set_ErrorMsg("発注先を選択してください。");

        $credentials = $request->validate([
            'factory_id' => ['required']
        ]);
        $ER_MSG->delete_ErrorMsg($ERMSG_ID_FACTORY_ID);

        //session取得
        $employee      = session()->get('employee');
        $account_id    = session()->get('account_id');
        $order_details = session()->get('order_details');

        //order_detailsが空ならダメ
        if(count($order_details) <= 0 ){
            $ER_MSG->set_ErrorMsg("家具１つ以上追加してください。");
            return redirect('OA/Order');
        }

        //factory_nameを取得
        $factory_id_res = Factory::fetch_name_where_id($request->factory_id);
        
        $data = [
            'base_id'      => $employee->base_id,
            'factory_name' => $factory_id_res->name,
            'factory_id'   => $request->factory_id,
            'account_id'   => $account_id,
            'order_at'     => date("Y-m-d"),
        ];


        return view('OA/Order/Check/OrderCheck', $data);
    }


    public function addFurniture(){
        //session
        if( session()->has('where_data') == null){
            $where_data =[
               'category_id' => '0',
               'search'      => '',
           ];
           session()->put('where_data', $where_data);
        }
        $where_data = session()->get('where_data');

        


        //オーバーロードできないゴミ言語ので無理やり分岐するためのフラグ
        $id_flag   = false;
        $name_flag = false;

        //where句作成
        if($where_data['category_id'] != 'none' && $where_data['category_id'] != '0'){
            $sql_where_category_id =  $where_data['category_id'] ;
            $id_flag = true;
        }
        if($where_data['search'] != null && $where_data['search'] != ''){
            $sql_where_search =  "%".$where_data['search']."%" ;
            $name_flag = true;
        }

        //家具情報取得(オーバーロードできないゴミ言語ので無理やり分岐)
        if($id_flag){
            if($name_flag){
                $furnitures = Furniture::fetch_info_where_id_nameLike($sql_where_category_id, $sql_where_search);
            }else{
                $furnitures = Furniture::fetch_info_where_id($sql_where_category_id);
            }
        }else{
            if($name_flag){
                $furnitures = Furniture::fetch_info_where_nameLike($sql_where_search);
            }else{
                $furnitures = Furniture::fetch_info();
            }
        }


        //categry情報を取得
        $categorys = Category::fect_all();
        $data = [
            'categorys'  => $categorys,
            'furnitures' => $furnitures
        ];

        return view('OA/Order/AddFurniture', $data);
    }


    public function addFurniturePost(Request $request){
        $where_data =[
            'category_id' => $request->category,
            'search'      => $request->search,
        ];
        session()->put('where_data', $where_data);


        return redirect('OA/Order/AddFurniture');
    }


    public function addFurnitureAdd(Request $request){

        $ER_MSG = new ErrorMsg();

        $ERMSG_ID_AnyInput = $ER_MSG->set_ErrorMsg("家具の選択または個数が入力されていません。");

        $credentials = $request->validate([
            'furniture_id'    => ['required'],
            'furniture_name'  => ['required'],
            'furniture_num'   => ['required'],
            'furniture_amout' => ['required']
        ]);
        $ER_MSG->delete_ErrorMsg($ERMSG_ID_AnyInput);


        if($request->furniture_num <= 0){
            $ER_MSG->set_ErrorMsg("個数は１以上を入力してください。");
            return redirect('OA/Order/AddFurniture');
        }


        //session取得
        $order_details = session()->get('order_details');


        //すでにある注文か確認
        $index=0;
        foreach($order_details as $order_detail){
            if($order_detail["furniture_id"] == $request->furniture_id){
                $order_details[$index]["furniture_num"]   += $request->furniture_num;
                $order_details[$index]["furniture_amout"] += $request->furniture_amout;
                
                session()->put('order_details', $order_details);
                return redirect('OA/Order');
            }
            $index += 1;
        }


        //無ければ追加
        array_push($order_details, [
            'furniture_id'    => $request->furniture_id,
            'furniture_name'  => $request->furniture_name,
            'furniture_num'   => $request->furniture_num,
            'furniture_amout' => $request->furniture_amout
        ]);


        session()->put('order_details', $order_details);
        return redirect('OA/Order');
    }

    public function addFurnitureEdit(Request $request){

        $data = [
            'furniture_id'    => $request->furniture_id,
            'furniture_name'  => $request->furniture_name,
            'furniture_num'   => $request->furniture_num,
            'furniture_amout' => $request->furniture_amout,
            'furniture_price' => $request->furniture_amout / $request->furniture_num
        ];

        return view('OA/Order/AddFurniture/Edit', $data);
    }

    public function addFurnitureEditDo(Request $request){
        $ER_MSG = new ErrorMsg();

        

        if($request->furniture_num <= 0){
            $data = [
                'furniture_id'    => $request->furniture_id,
                'furniture_name'  => $request->furniture_name,
                'furniture_num'   => $request->furniture_num,
                'furniture_amout' => $request->furniture_amout,
                'furniture_price' => $request->furniture_price 
            ];
            $ER_MSG->set_ErrorMsg("個数を１以上の数にしてください。");
            return view('OA/Order/AddFurniture/Edit', $data);
        }

        //session取得
        $order_details = session()->get('order_details');

        //更新
        $index=0;
        foreach($order_details as $order_detail){
            if($order_detail["furniture_id"] == $request->furniture_id){
                $order_details[$index]["furniture_num"]   = $request->furniture_num;
                $order_details[$index]["furniture_amout"] = $request->furniture_amout;
                
                session()->put('order_details', $order_details);
                return redirect('OA/Order');
            }
            $index += 1;
        }

        return redirect('OA/Order');
    }

    public function delete(Request $request){

        //session取得
        $order_details = session()->get('order_details');

        //更新
        $index=0;
        foreach($order_details as $order_detail){
            if($order_detail["furniture_id"] == $request->furniture_id){
                unset($order_details[ $index]);

                session()->put('order_details', $order_details);
                return redirect('OA/Order');
            }
            $index += 1;
        }

        return redirect('OA/Order');
    }

    public function insert(Request $request){

        //バリデーション
        $credentials = $request->validate([
            'factory_id' => ['required'],
            'base_id'    => ['required'],
            'account_id' => ['required'],
            'order_at'   => ['required']
        ]);

        //session取得
        $order_details = session()->get('order_details');


        Order::insert($request->base_id, $request->factory_id, $request->account_id, $request->order_at);

        $order_id = Order::fetch_max_id()->id; 

        //OrderDetail
        $index = 1;
        foreach($order_details as $order_detail){
            OrderDetail::insert($order_id, $order_detail["furniture_id"], $index, $order_detail["furniture_num"], $order_detail["furniture_amout"]);
            $index += 1;
        }

        $request->session()->forget('order_details');

        return redirect('/OA/top');
    }

}
