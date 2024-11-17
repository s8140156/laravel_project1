<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    {{-- 因為使用的laravel版本不同(教學使用ver.8 目前使用ver.11.21) 因使用的是vite所以by以下vite指令 --}}
    @vite('resources/css/app.css') {{--vite指令--}}
    {{--要依照vite指令 css才會正確導入 才有正確的css樣式--}}
    <title>CRUD</title>
</head>
<body>
    <main class="m-5">
        @if(session()->has('notice'))
        <div class="bg-pink-300 px-3 py-2 rounded">
            {{session()->get('notice')}}
            {{-- 使用get()取得訊息 --}}
        </div>
        @endif
        @yield('main')
    </main>
   {{-- <script src="{{asset('js/app.js')}}"></script>   --}}
   @vite('resources/js/app.js')
   {{--可以在vite.config.js查詢到以上css, js路徑--}}
</body>
</html>