@extends('layouts.app')

@section('content')


<div class="w-screen  pt-10">
    <div class="my-5">
        <a class="ml-5 border border-black rounded-2xl px-8 py-2 text-white bg-[#2b2b2b]   hover:bg-red-800 " href="{{ route('Order') }}">戻る</a>
    </div>
</div>
<div class="pt-10 pl-10   w-screen pb-5">
        <form method="POST" action="{{ route('AddFurnitureEditDo') }}" class="m-5">
            @csrf
            @method('PUT')
            <div class="flex-wrap">
                <div class="flex text-3xl">
                    <div class="">家具名　：</div>
                    <input type="text" readonly style="pointer-events: none;" class="font-bold bg-opacity-0" value="{{ $furniture_name }}" id="check_furniture_name" name="furniture_name">
                </div>
                <div class="flex text-3xl">
                    <div class="">値段　　：</div>
                    <div class=" font-bold" id="check_furniture_price">{{ $furniture_price }}</div>
                </div>
                <div class="flex text-3xl">
                    <div class="">個数　　：</div>
                    <input type="number" oninput="inputChange()" class=" no-spin rounded-lg w-[50px] text-end px-1 border border-black" value="{{ $furniture_num }}" id="check_furniture_num" name="furniture_num">
                </div>
            </div>
            <div class="flex items-end">
                <div class="flex text-3xl">
                    <div class="">合計金額：</div>
                    <input type="text" readonly style="pointer-events: none;" class="font-bold w-[150px] bg-opacity-0" value="{{ $furniture_amout }}" id="check_furniture_amout" name="furniture_amout">
                </div>
                <input type="text" style="display: none;" value="{{ $furniture_id }}"  name="furniture_id">
                <input type="text" style="display: none;" value="{{ $furniture_price }}"  name="furniture_price">
                <button class="ml-5 border border-black rounded-2xl px-8 py-2 text-2xl text-black bg-blue-400  hover:text-white  hover:bg-blue-800 ">変更する</button>
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
        check_furniture_price = document.getElementById("check_furniture_price")
        check_furniture_amout = document.getElementById("check_furniture_amout")
        check_furniture_id    = document.getElementById("check_furniture_id")

        //計算に使用するelm
        check_furniture_num   = document.getElementById("check_furniture_num")

        function inputChange(){
            //変更する
            check_furniture_amout.value = check_furniture_price.innerText * check_furniture_num.value            
        }



        
        

    </script>
@endsection