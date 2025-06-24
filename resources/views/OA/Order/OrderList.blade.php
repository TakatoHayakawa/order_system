@extends('layouts.app')

@section('content')

    
    <div class="w-screen pt-10">

            <div>
                <div class="pl-10 flex items-center">
                    <a class=" border border-black rounded-2xl px-8 py-2 text-white bg-[#2b2b2b]   hover:bg-red-800 " href="{{ route('Home') }}">戻る</a>
                </div>
            </div>


            <div class="">
                <div class="w-full flex justify-center">
                    <div class="w-[70vw]">
                        <div class="grid grid-cols-11 border border-black font-bold text-lg">
                            <!-- グリッド内のコンテンツをここに配置 -->
                            <div class="grid-item flex justify-center col-span-3">発注先</div>
                            <div class="grid-item flex justify-center border-l border-black col-span-3">発注元</div>
                            <div class="grid-item flex justify-center border-x border-black col-span-3">発注者</div>
                            <div class="grid-item flex justify-center border-r border-black col-span-2">発注日</div>
                        </div>  
                        <?php foreach($Orders as $order){ ?>
                            <a href="{{ route('OrderDetailt', ['id' => $order->order_id]) }}">
                                <div class="grid grid-cols-11 border-b border-black text-lg">
                                    <!-- グリッド内のコンテンツをここに配置 -->
                                    <div class="grid-item border-l border-black col-span-3 pl-2 pt-2">{{ $order->factory_name }}</div>
                                    <div class="grid-item flex border-l border-black col-span-3 pl-2 pt-2">{{ $order->base_name }}</div>
                                    <div class="grid-item flex border-x border-black col-span-3 pl-2 pt-2">{{ $order->employee_name }}</div>
                                    <div class="grid-item flex border-r border-black col-span-2 pr-2 pt-2">{{ $order->order_at }}</div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>

        
    </div>
@endsection