@extends('layouts.app')

@section('content')

    
    <div class="w-screen pt-10">

            <div>
                <div class="pl-10 flex items-center">
                    <a class=" border border-black rounded-2xl px-8 py-2 text-white bg-[#2b2b2b]   hover:bg-red-800 " href="{{ route('OrderList') }}">戻る</a>
                </div>
                <div class="flex justify-between items-end px-10 py-2 border-b-2 border-b border-black mb-5">
                    <div class="flex items-center">
                        <div>
                            発注先：
                        </div>
                        <div>{{ $Order->factory_name }}</div>
                    </div>
                    <div class="flex gap-5">
                        <div class="text-right">
                            <div >発注元：</div>
                            <div >発注者：</div>
                            <div >発注日：</div>
                        </div>
                        <div class="text-right">
                            <div >{{ $Order->base_name }}</div>
                            <div >{{ $Order->employee_name }}</div>
                            <div >{{ $Order->order_at }}</div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="">
                <div class="w-full flex justify-center">
                    <div class="w-[70vw]">
                        <div class="grid grid-cols-9 border border-black font-bold text-lg">
                            <!-- グリッド内のコンテンツをここに配置 -->
                            <div class="grid-item flex justify-center col-span-4">家具名</div>
                            <div class="grid-item flex justify-center border-x border-black col-span-1">発注個数</div>
                            <div class="grid-item flex justify-center border-r border-black col-span-2">入荷済み個数</div>
                            <div class="grid-item flex justify-center border-r border-black col-span-2">値段</div>
                            
                        </div> 
                        <?php foreach($orderDetailts as $orderDetailt){ ?>
                            <div>
                                <div class="grid grid-cols-9 border-b border-black text-lg">
                                    <!-- グリッド内のコンテンツをここに配置 -->
                                    <div class="grid-item border-l border-black col-span-4 pl-2 pt-2">{{ $orderDetailt->furniture_name }}</div>
                                    <div class="grid-item flex justify-center border-x border-black col-span-1 pl-2 pt-2">{{ $orderDetailt->order_num }}</div>
                                    <div class="grid-item flex justify-center border-r border-black col-span-2 pl-2 pt-2">{{ $orderDetailt->shipped_num }}</div>
                                    <div class="grid-item flex justify-end border-r border-black col-span-2 pr-2 pt-2">{{ $orderDetailt->amout }}ベル</div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        
    </div>
@endsection