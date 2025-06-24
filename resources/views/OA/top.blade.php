@extends('layouts.app')

@section('content')
    <div class="flex justify-center  w-full pt-[20vh] ">
        <div class="flex gap-[100px] "> 
            <a class="flex items-center btn pointer border border-black rounded-lg text-5xl px-8 py-2 text-white bg-[#2b2b2b] hover:bg-blue-200 hover:text-[#2b2b2b] h-[100px]" href="{{ route('Order') }}">
                <div class="">発注</div>
            </a>
            
            <a class="flex items-center btn pointer border border-black rounded-lg text-5xl px-8 py-2 text-white bg-[#2b2b2b] hover:bg-blue-200 hover:text-[#2b2b2b] h-[100px]" href="{{ route('OrderList') }}">
                <div class="">発注一覧</div>
            </a>
        </div>
    </div>
@endsection