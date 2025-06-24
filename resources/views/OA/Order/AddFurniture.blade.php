@extends('layouts.app')

@section('content')
<?php
    $where_data = session()->get('where_data');
?>  

<div class="w-screen  pt-10">
    <div class="my-5">
        <a class="ml-5 border border-black rounded-2xl px-8 py-2 text-white bg-[#2b2b2b]   hover:bg-red-800 " href="{{ route('Order') }}">戻る</a>
    </div>
    <form method="post" action="{{ route('AddFurniturePost') }}" class="m-5">
        @csrf
        <select name="category" class="border border-black rounded-lg  p-1" id="category_select">
            <?php if( $where_data['category_id'] == '0' ){ ?>
                <option value="0" selected hidden>カテゴリー選択</option>
            <?php } ?>

            <?php if( $where_data['category_id'] == 'none' ){ ?>
                <option value="none" selected>なし</option>
            <?php }else{ ?>
                <option value="none" >なし</option>
            <?php } ?>
            
            <?php foreach($categorys as $category){ ?>
                <?php if( $where_data['category_id'] == $category->id ){ ?>
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    <?php continue ?>
                <?php } ?>
                <option value="{{ $category->id }}" >{{ $category->name }}</option>
            <?php } ?>
        </select>
        <input type="text" name="search" class="border border-black rounded-lg p-1 text-lg ml-5" placeholder="キーワード入力" value="{{ $where_data['search'] }}">
        <button type="submit" class="border border-black rounded-lg p-1 text-lg text-black bg-blue-400 hover:text-white  hover:bg-blue-800">検索</button>
    </form>
    <div class="border-t border-black flex ">
        <div class="w-[60vw] h-[30vh] 2xl:h-[45vh] ml-5  overflow-y-scroll ">
            <div class="grid grid-cols-9 border-x border-b border-black font-bold text-lg">
                <!-- グリッド内のコンテンツをここに配置 -->
                <div class="grid-item flex justify-center col-span-5 border-r border-black">家具名</div>
                <div class="grid-item flex justify-center col-span-3">値段</div>
                <div class="grid-item flex justify-center col-span-1"></div>
            </div> 

            
            <?php foreach($furnitures as $furniture){ ?>
                <div class="cursor-pointer grid grid-cols-8 border-b border-black text-xl" id="{{ $furniture->id }}">
                    <!-- グリッド内のコンテンツをここに配置 -->
                    <div class="furniture_name pointer grid-item border-l border-black col-span-5 pl-2 py-2  border-r border-black">{{ $furniture->name }}</div>
                    <div class="furniture_price grid-item flex justify-end border-r border-black col-span-3 pr-2 py-2">{{ $furniture->price }}</div>
                </div>
            <?php } ?>
            

        </div>
    </div>
</div>
<div class="pt-10 pl-10 border-black border-double border-t-4 fixed  w-screen pb-5">
    <form method="post" action="{{ route('AddFurnitureAdd') }}" class="">
        @csrf
            <div class="flex-wrap">
                <div class="flex text-3xl">
                    <div class="">家具名　：</div>
                    <input type="text" readonly style="pointer-events: none;" class="font-bold " value="" id="check_furniture_name" name="furniture_name">
                </div>
                <div class="flex text-3xl">
                    <div class="">値段　　：</div>
                    <input type="text" readonly style="pointer-events: none;" class="font-bold " value="" id="check_furniture_price">
                </div>
                <div class="flex text-3xl my-1">
                    <div class="">個数　　：</div>
                    <input type="number" oninput="inputChange()" class=" no-spin rounded-lg w-[50px] text-end px-1 border border-black" value="1" id="check_furniture_num" name="furniture_num">
                </div>
            </div>
        <div class="flex items-end">
            <div class="flex text-3xl">
                <div class="">合計金額：</div>
                <input type="text"  readonly style="pointer-events: none;" class="font-bold w-[150px] " value="0" id="check_furniture_amout" name="furniture_amout">
            </div>
            <input type="text" style="display: none;" value="" id="check_furniture_id" name="furniture_id">
            <button type="submit" class="ml-5 border border-black rounded-2xl px-8 py-2 text-2xl text-black bg-blue-400 hover:text-white  hover:bg-blue-800 ">追加する</button>
        </div>
        <style>
            .no-spin::-webkit-inner-spin-button,
            .no-spin::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
                -moz-appearance:textfield;
            }
        </style>
    </form>

</div>

        <script>
        //変更するelm
        check_furniture_name  = document.getElementById("check_furniture_name")
        check_furniture_price = document.getElementById("check_furniture_price")
        check_furniture_amout = document.getElementById("check_furniture_amout")
        check_furniture_id    = document.getElementById("check_furniture_id")

        //計算に使用するelm
        check_furniture_num   = document.getElementById("check_furniture_num")

        function inputChange(){
            //変更する
            check_furniture_amout.value = check_furniture_price.value * check_furniture_num.value            
        }


        <?php foreach($furnitures as $furniture){ ?>
            document.getElementById('{{ $furniture->id }}').addEventListener("click", ()=>{
                furniture_name  = document.getElementById('{{ $furniture->id }}').getElementsByClassName("furniture_name")[0]
                furniture_price = document.getElementById('{{ $furniture->id }}').getElementsByClassName("furniture_price")[0]
    
                //変更する
                check_furniture_name.value  = furniture_name.innerText
                check_furniture_price.value = furniture_price.innerText
                check_furniture_amout.value = furniture_price.innerText * check_furniture_num.value
                check_furniture_id.value    = '{{ $furniture->id }}'
            })
        <?php } ?>
        
        

    </script>
@endsection