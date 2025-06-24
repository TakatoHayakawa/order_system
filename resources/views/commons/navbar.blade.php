<?php
    $employee =  session()->get('employee')
?>

<div class="px-10 py-2 flex items-end justify-between bg-red-200">
    <div class="font-bold text-3xl"><a href="{{ route('Home') }}">OAの森</a></div>
    <div class="flex gap-5 font-bold items-center">
        @if (Auth::check())
        <div>{{ $employee->department_name }}</div>
        <div>{{ $employee->base_name }}</div>
        <div>{{ $employee->employee_name }}</div>
        <form method="post" action="{{ route('authLogout') }}">
            @csrf
            <button class="border border-black rounded-3xl px-3 py-2 ml-10 text-white bg-[#2b2b2b]   hover:bg-red-800 " type="submit">Logout</button>
        </form>
        @endif
    </div>
</div>