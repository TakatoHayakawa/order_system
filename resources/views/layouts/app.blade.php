<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>OAの森</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
    </head>

    <body >
        

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        <div class="">

            @if ($_SERVER['REQUEST_URI'] == "/Signup" or $_SERVER['REQUEST_URI'] == "/Login")
                @yield('content')
            @elseif (Auth::check())
                @yield('content')
            @else
                @include('commons.login_hoge')
            @endif

            {{-- エラーメッセージ --}}
            @include('commons.error_messages')
        </div>

        

    </body>
</html>