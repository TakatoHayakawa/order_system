@extends('layouts.app')

@section('content')
    <?php
        $employee      = session()->get('employee');
        $order_details = session()->get('order_details');
    ?>
    
    <div class="w-screen pt-10">

            <div>
                <form method="post" action="{{ route('OrderInsert') }}" class="pl-10 flex items-center">
                    @csrf
                    <input type="text" style="display: none;" value="{{ $factory_id }}"   name="factory_id">
                    <input type="text" style="display: none;" value="{{ $base_id }}"      name="base_id">
                    <input type="text" style="display: none;" value="{{ $account_id }}"   name="account_id">
                    <input type="text" style="display: none;" value="{{ date('Y-m-d') }}" name="order_at">

                    <button class="border border-black rounded-2xl   px-3 py-2 mr-5 text-white bg-blue-400 hover:bg-blue-800" type="submit">登録する</button>
                    <a class=" border border-black rounded-2xl px-8 py-2 text-white bg-[#2b2b2b]   hover:bg-red-800 " href="{{ route('Order') }}">戻る</a>
                </form>
                <div class="flex justify-between items-end px-10 py-2 border-b-2 border-b border-black mb-5">
                    <div class="flex items-center">
                        <div>
                            発注先：
                        </div>
                        <div>{{ $factory_name }}</div>
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
                            <div >{{ $order_at }}</div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="">
                <div class="w-full flex justify-center">
                    <div class="w-[70vw]">
                        <div class="grid grid-cols-8 border border-black font-bold text-lg">
                            <!-- グリッド内のコンテンツをここに配置 -->
                            <div class="grid-item flex justify-center col-span-5">家具名</div>
                            <div class="grid-item flex justify-center border-x border-black col-span-1">個数</div>
                            <div class="grid-item flex justify-center border-r border-black col-span-2">値段</div>
                            
                        </div> 
                        <?php foreach($order_details as $order_detail){ ?>
                            <div>
                                @csrf
                                <div class="grid grid-cols-8 border-b border-black text-lg">
                                    <!-- グリッド内のコンテンツをここに配置 -->
                                    <div class="grid-item border-l border-black col-span-5 pl-2 pt-2">{{ $order_detail['furniture_name'] }}</div>
                                    <div class="grid-item flex justify-center border-x border-black col-span-1 pl-2 pt-2">{{ $order_detail['furniture_num'] }}</div>
                                    <div class="grid-item flex justify-end border-r border-black col-span-2 pr-2 pt-2">{{ $order_detail['furniture_amout'] }}ベル</div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        
    </div>
@endsection