@extends('layouts.app')

@section('content')
    <div class="flex  justify-center  w-full pt-[20vh]">
        <div class="flex-wrap w-80 p-5">
            <form method="POST" action="{{ route('authLogin') }}" class="border-b-4 border-b border-black"> 
                @csrf
                <div class="flex justify-between items-center pb-5 ">
                    <div class="text-2xl">ID</div>
                    <input name="email" class="p-2 rounded-md border border-black" type="text">
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-2xl">PW</div>
                    <input name="password" class="p-2 rounded-md border border-black" type="password">
                </div>
                <div class="flex w-full justify-center py-4">
                    <button type="submit" class="cursor-pointer border border-black rounded-lg px-8 py-2 text-white bg-[#2b2b2b]  hover:bg-blue-200 hover:text-[#2b2b2b]">login</button>
                </div>
            </form>
            <div class="flex w-full justify-center py-4">
                <a href="{{ route('Signup') }}">
                    <div class="btn border border-black rounded-lg px-8 py-2 text-white bg-[#2b2b2b] hover:bg-blue-200 hover:text-[#2b2b2b]">Signup</div>
                </a>
            </div>
        </div>
     </div>
@endsection