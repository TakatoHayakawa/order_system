@extends('layouts.app')

@section('content')
    <?php
        $employee      = session()->get('employee');
        $order_details = session()->get('order_details');
    ?>
    
    <div class="w-screen pt-10">

            <form method="POST" action="{{ route('OrderCheck') }}">
                @csrf
                <div class="pl-10 flex items-center">
                    <a class=" border border-black rounded-2xl px-8 py-2 text-white bg-[#2b2b2b]   hover:bg-red-800 " href="{{ route('Home') }}">戻る</a>
                    <button class="border border-black rounded-2xl   px-3 py-2 ml-5 text-white bg-blue-400 hover:bg-blue-800" type="submit">確認へ進む</button>
                </div>   
                <div class="flex justify-between items-end px-10 py-2 border-b-2 border-b border-black">
                    <div class="flex items-center">
                        <div>
                            発注先：
                        </div>
                        <select name="factory_id" class="border border-black rounded-lg px-1">
                            <option value="" selected hidden>選択</option>
                            
                            
                            <?php foreach($factorys as $factory){ ?>
                                <option value="{{ $factory->id }}" >{{ $factory->name }}</option> 
                            <?php } ?>
                            

                        </select>
                    </div>
                    <div class="flex gap-5">
                        <div class="text-right">
                            <div >発注元：</div>
                            <div >発注者：</div>
                            <div >発注日：</div>
                        </div>
                        <div class="text-right">
                            <div >{{ $employee->base_name }}</div>
                            <div >{{ $employee->employee_name }}</div>
                            <div >{{ date("Y-m-d") }}</div>
                        </div>
                    </div>
                </div>
            </form>

             <div class="">
                <div class="py-[30px]">
                    <a class="border border-black rounded-2xl px-3 py-4 ml-14 text-white bg-blue-400 text-xl  hover:bg-blue-800 " href="{{ route('AddFurniture') }}">
                        家具を追加する
                    </a>
                </div>
                <div class="w-full flex justify-center">
                    <div class="w-[70vw]">
                        <div class="grid grid-cols-10 border border-black font-bold text-lg">
                            <!-- グリッド内のコンテンツをここに配置 -->
                            <div class="grid-item flex justify-center col-span-5">家具名</div>
                            <div class="grid-item flex justify-center border-x border-black col-span-1">個数</div>
                            <div class="grid-item flex justify-center border-r border-black col-span-2">値段</div>
                            <div class="grid-item flex justify-center col-span-2"></div>
                        </div> 
                        <?php if( count($order_details) != 0 ){ ?>
                            <?php foreach($order_details as $order_detail){ ?>
                                <form method="POST" action="{{ route('AddFurnitureEdit') }}">
                                    @csrf
                                    <div class="grid grid-cols-10 border-b border-black text-lg">
                                        <!-- グリッド内のコンテンツをここに配置 -->
                                        <div class="grid-item border-l border-black col-span-5 pl-2 pt-2">{{ $order_detail['furniture_name'] }}</div>
                                        <div class="grid-item flex justify-center border-x border-black col-span-1 pl-2 pt-2">{{ $order_detail['furniture_num'] }}</div>
                                        <div class="grid-item flex justify-end border-r border-black col-span-2 pr-2 pt-2">{{ $order_detail['furniture_amout'] }}ベル</div>
                                        <div class="grid-item flex justify-center border-r border-black col-span-2">
                                            <input type="text" style="display: none;" value="{{ $order_detail['furniture_name'] }}"  name="furniture_name">
                                            <input type="text" style="display: none;" value="{{ $order_detail['furniture_num'] }}"   name="furniture_num">
                                            <input type="text" style="display: none;" value="{{ $order_detail['furniture_amout'] }}" name="furniture_amout">
                                            <input type="text" style="display: none;" value="{{ $order_detail['furniture_id'] }}" name="furniture_id">
                                            <button class="text-sm border border-black rounded-lg text-white px-2 my-1 bg-blue-400 hover:bg-blue-800 ">編集</button>
                                            <a href="{{ route('Delete',  ['furniture_id' => $order_detail['furniture_id']] ) }}" class="text-sm border border-black rounded-lg text-white px-2 my-1 bg-red-400 hover:bg-red-800  flex items-center ml-1">削除</a>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>

        
    </div>
@endsection