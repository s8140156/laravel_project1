@extends('layouts.article')

{{-- 這個show.view是點選標題 進入看整個內容(含標題＋內文路徑) --}}

@section('main')
<h1 class="font-thin text-4xl my-3">{{$article->title}}</h1>
<p class="text-lg text-gray-700 p-2">{!!$article->content!!}</p>
{{-- 因使用WYSIWYG(所見即所得)編輯器 則在網頁上進行樣式編輯 存入資料表會將內文及html tag(樣式)一併存入資料表中 --}}
{{-- 所以當從後端將數據輸出到前端 使用{!! !!}(blade語法)渲染html --}}
{{-- {!! !!}是 Laravel的Blade模板語法，用於直接輸出 HTML，而不進行字符編碼（避免將 HTML 標籤轉譯成純文字）--}}
{{--  將存儲於資料庫中的 HTML 格式內容正確地呈現在前端 --}}
{{-- 這段語法通常出現在顯示內容的頁面，例如文章詳細頁或列表頁，目的是將用戶通過 CKEditor 編輯後的內容以 HTML 格式顯示在頁面上  --}}
<a style="color:blue" href="{{route('articles.index')}}">回文章列表</a>


@endsection